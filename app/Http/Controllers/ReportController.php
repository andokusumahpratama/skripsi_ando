<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pangkalan;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    // ! REWARD
    public function Perhitungan($startDate = null, $endDate = null)
    {                
        $startDate = $startDate ?? now()->startOfYear()->format('Y-m-d');
        $endDate = $endDate ?? now()->format('Y-m-d');                
        
        // $pangkalans = Pangkalan::with('transaksis', 'hutangs')->get();
        $pangkalans = Pangkalan::with(['transaksis' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }, 'hutangs' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }])->get();        

        $data = [];
        

        foreach($pangkalans as $pangkalan){            

            $totalPenebusan = $pangkalan->transaksis->sum(function($transaksi){                
                return $transaksi->penebusan_tabung ?? 0;
            });

            $totalPembayaran = $pangkalan->transaksis->sum(function($transaksi){
                return $transaksi->pembayaran ?? 0;
            });

            $totalHutangPembayaran = $pangkalan->hutangs->sum(function ($hutang) {
                return $hutang->hutang_pembelian ?? 0;
            });
    
            $totalHutangTabung = $pangkalan->hutangs->sum(function ($hutang) {
                return $hutang->hutang_tabung ?? 0;
            });

            $data[] = [
                'pangkalan' => $pangkalan->nama_pangkalan,
                'total_penebusan' => $totalPenebusan,
                'total_pembayaran' => $totalPembayaran,
                'total_hutang_pembayaran' => $totalHutangPembayaran,
                'total_hutang_tabung' => $totalHutangTabung,
            ];
        }

        return $data;
    }

    // ! REWARD
    public function Copras($bobot1 = null, $bobot2 = null, $bobot3 = null, $bobot4 = null, $start = null, $end = null)
    {
        $bobot1 = $bobot1 ?? 0.2; 
        $bobot2 = $bobot2 ?? 0.4; 
        $bobot3 = $bobot3 ?? 0.15;
        $bobot4 = $bobot4 ?? 0.25;
        $start = $start ?? now()->startOfYear();
        $end = $end ?? now();            

        $data = $this->Perhitungan($start, $end);         

        foreach ($data as $key => $value) {
            $X[] = [
                $value['total_penebusan'],
                $value['total_pembayaran'],
                $value['total_hutang_pembayaran'],
                $value['total_hutang_tabung'],
                $value['pangkalan']
            ];
        }        
            
        $w = [$bobot1, $bobot2, $bobot3, $bobot4];

        // Normalize matrix X
        $C1 = array_reduce($X, function($acc, $curr) {
            return $acc + $curr[0];
        }, 0);

        $C2 = array_reduce($X, function($acc, $curr) {
            return $acc + $curr[1];
        }, 0);

        $C3 = array_reduce($X, function($acc, $curr) {
            return $acc + $curr[2];
        }, 0);

        $C4 = array_reduce($X, function($acc, $curr) {
            return $acc + $curr[3];
        }, 0);

        $A = array_map(function($x) use($C1, $C2, $C3, $C4) {
            return [
                // return $data == 0 ? 0 : 1/$data;
                $C1 == 0 ? 0 : $x[0] / $C1,
                $C2 == 0 ? 0 : $x[1] / $C2,
                $C3 == 0 ? 0 : $x[2] / $C3,
                $C4 == 0 ? 0 : $x[3] / $C4,
            ];
        }, $X);

        // Apply weight to matrix A
        $AW = array_map(function($a) use($w) {
            return [
                $a[0] * $w[0],
                $a[1] * $w[1],
                $a[2] * $w[2],
                $a[3] * $w[3],
            ];
        }, $A);

        // Calculate S+ and S-
        $Splus = [];
        $Sminus = [];

        array_map(function($row) use(&$Splus, &$Sminus) {
            $sumPlus = $row[0] + $row[1];
            $sumMinus = $row[2] + $row[3];
            array_push($Splus, $sumPlus);
            array_push($Sminus, $sumMinus);
        }, $AW);

        // Inverse S-
        $SminusInv = array_map(function($data) {
            return $data == 0 ? 0 : 1/$data;
        }, $Sminus);

        $total = array_reduce($SminusInv, function($acc, $cur) {
            return $acc + $cur;
        });

        $resultSminus = array_map(function($data) use($total) {
            return $data * $total;
        }, $Sminus);

        $Qi = [];
        for ($i = 0; $i < count($resultSminus); $i++) {
            if ($resultSminus[$i] != 0) {
                $Qi[$i] = $Splus[$i] + (($w[2] + $w[3]) / $resultSminus[$i]);
            } else {
                $Qi[$i] = $Splus[$i] + 0;
            }
        }

        $maxQi = max($Qi);
            
        $Ui = array_map(function($data, $i) use ($X, $maxQi) {
            return [
                'index' => $X[$i][4],
                'value' => $data == 0 ? 0 : ($data / $maxQi) * 100,
            ];
        }, $Qi, array_keys($Qi));
        
        // Sort the Ui descendingly by value
        usort($Ui, function($a, $b) {
          return $b["value"] - $a["value"];
        });
        
        // Print the result
        return $Ui;
    }

    // ! REWARD
    public function rewardPangkalan()
    {
        $data = $this->Perhitungan();                        
        
        $copras = json_decode(json_encode($this->Copras()));
        
        // ! MEMBUAT PAGINATE MANUAL
        // $copras = json_decode(json_encode($this->Copras()));
        // $perPage = 10;
        // $page = request()->get('page', 0); // Mendapatkan nilai halaman saat ini
        // $copras = collect($copras); // Mengubah array menjadi collection
        // $copras = new LengthAwarePaginator(
        //     $copras->forPage($page, $perPage), // Mengambil data untuk halaman saat ini
        //     $copras->count(), // Total data
        //     $perPage, // Jumlah data per halaman
        //     $page, // Halaman saat ini
        //     ['path' => url()->current()] // URL halaman saat ini
        // );        
       
        // $previousUrl = $copras->previousPageUrl();
        // $nextUrl = $copras->nextPageUrl();

        return view('report.reward', compact('data', 'copras'));

    }

    // ! REWARD
    public function filterReward(Request $request)
    {
        
        $startDate = $request->start == null ? now()->startOfYear()->format('Y-m-d') : Carbon::createFromFormat('d M, Y', $request->start);
        $endDate = $request->end == null ? now() : Carbon::createFromFormat('d M, Y', $request->end);
        $star = $request->start;
        $end = $request->end; 
        $t_pembelian_tabung = $request->t_pembelian_tabung;
        $t_pembelian_rupiah = $request->t_pembelian_rupiah;
        $t_hutang_pembelian = $request->t_hutang_pembelian;
        $t_kurang_kembali_tabung = $request->t_kurang_kembali_tabung;

        $bobotPembelianTabung = $request->t_pembelian_tabung/100;
        $bobotPembelianRupiah = $request->t_pembelian_rupiah/100;
        $bobotHutangPembelian = $request->t_hutang_pembelian/100;
        $bobotKurangTabungGas = $request->t_kurang_kembali_tabung/100;
        
        $data = $this->Perhitungan($startDate, $endDate);
        $copras = json_decode(json_encode($this->Copras($bobotPembelianTabung, $bobotPembelianRupiah, $bobotHutangPembelian, $bobotKurangTabungGas, $startDate, $endDate)));        
        return view('report.reward', compact('data', 'copras', 'star', 'end', 't_pembelian_tabung', 't_pembelian_rupiah', 't_hutang_pembelian', 't_kurang_kembali_tabung'));
    }

    

    public function downloadPDF()
    {        
        $pdf = FacadePdf::loadView('laporanInvoice');
        ini_set('max_execution_time', 200);
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
        // return $pdf->download('data.pdf');            

    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hutang;
use App\Models\JualTabung;
use App\Models\Pembelian_Tabung;
use App\Models\StokBarang;
use App\Models\Transaksi;
use App\Models\TransaksiHutang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    public function index()
    {
        $year = date('Y');

        $barangss = DB::table('barangs')
        ->join('jual_tabung', 'barangs.id', '=', 'jual_tabung.barangt_id')
        ->join('transaksis', 'jual_tabung.id', '=', 'transaksis.jual_tabung_id')
        ->select('barangs.nama_barang', DB::raw('SUM(transaksis.penebusan_tabung) AS total_penebusan'))
        ->whereYear('transaksis.created_at', $year)
        ->groupBy('barangs.nama_barang')
        ->get();

        //* LINE CHART TRANSAKSI PEMBAYARAN
        $transaksiLine = Transaksi::select(
                DB::raw('MONTH(created_at) AS bulan'), DB::raw('SUM(pembayaran) AS jumlah_pembayaran'
            ))->whereYear('created_at', $year)->groupBy('bulan')->get();     
        $MonthOrWeek = 'month';          
        $month = $transaksiLine->pluck('bulan')->unique();

        //* BAR CHART                 
        $penjualanBarang = DB::table('transaksis')
            ->join('jual_tabung', 'transaksis.jual_tabung_id', '=', 'jual_tabung.id')
            ->join('barangs', 'jual_tabung.barangt_id', '=', 'barangs.id')
            ->select('barangs.nama_barang', DB::raw('MONTH(transaksis.created_at) as bulan'), DB::raw('SUM(transaksis.penebusan_tabung) as total'))
            ->whereYear('transaksis.created_at', $year)
            ->groupBy('barangs.nama_barang', 'bulan')
            ->get();
        
        $barang = $penjualanBarang->pluck('nama_barang')->unique()->toArray();             
        $barang = array_values($barang);        
        $bulanData = $penjualanBarang->pluck('bulan')->unique()->toArray();
        $jmlBulan = count($bulanData);

        $data = array_fill(0, $jmlBulan, array_fill(0, count($barang), 0));

        // Memasukkan data ke dalam array sesuai dengan bulan dan barang
        foreach ($penjualanBarang as $penjualan) {
            $bulan = $penjualan->bulan - 1; // Karena array dimulai dari 0
            $barangIndex = array_search($penjualan->nama_barang, $barang);            
            $data[$bulan][$barangIndex] = $penjualan->total;                        
        }        
        // dd($penjualanBarang, $data, $barang);     
        
        // * CARD INFO
        $stok = StokBarang::all();        
        $transaksi = Transaksi::whereDate('created_at', Carbon::now())->get();      
        $pembelianTabung = Pembelian_Tabung::whereDate('created_at', Carbon::now())->orWhereDate('updated_at', Carbon::now())->get();          
        // $bayarHutangTabung = Hutang::whereDate('updated_at', Carbon::now())->get();
        $bayarHutangTabung = TransaksiHutang::whereDate('created_at', Carbon::now())->get();
        $stok_isi_akhir = StokBarang::whereDate('updated_at', Carbon::now())->get()->count() == 0 ? 0 : $stok->sum('jumlah_stok_isi');
        $stok_kosong_akhir = StokBarang::whereDate('updated_at', Carbon::now())->get()->count() == 0 ? 0 : $stok->sum('jumlah_stok_kosong');
        
        $stok_kosong_awal = ($stok->sum('jumlah_stok_kosong') - $transaksi->sum('kembali_kabung') ?? 0) + $pembelianTabung->sum('barang_keluar_kosong') ?? 0;    
        $stok_kosong_awal = $stok_kosong_awal - $bayarHutangTabung->sum('bayar_hutang_tabung') ?? 0;        

        $stok_isi_awal = ($stok->sum('jumlah_stok_isi') + $transaksi->sum('penebusan_tabung') ?? 0) - $pembelianTabung->sum('barang_masuk_isi') ?? 0;

        $stokData = [
            'stok_isi_awal' => $stok_isi_awal,              
            'stok_kosong_awal' => $stok_kosong_awal,
            'stok_isi_akhir' => $stok_isi_akhir,
            'stok_kosong_akhir' => $stok_kosong_akhir
        ];

        // dd($stokData);        

        return view('admin.index', compact('transaksiLine', 'data', 'barang', 'year', 'barangss', 'stokData', 'MonthOrWeek', 'month'));
    }

    public function filterDashboard(Request $request)
    {
        $year = date('Y');
        $startDate = $request->start == null ? now()->startOfYear()->format('Y-m-d') : Carbon::createFromFormat('d M, Y', $request->start);
        $endDate = $request->end == null ? now() : Carbon::createFromFormat('d M, Y', $request->end);        
        $star = $request->start;
        $end = $request->end;        

        $barangss = DB::table('barangs')
        ->join('jual_tabung', 'barangs.id', '=', 'jual_tabung.barangt_id')
        ->join('transaksis', 'jual_tabung.id', '=', 'transaksis.jual_tabung_id')
        ->select('barangs.nama_barang', DB::raw('SUM(transaksis.penebusan_tabung) AS total_penebusan'))
        ->whereBetween('transaksis.created_at', [$startDate, $endDate])
        ->groupBy('barangs.nama_barang')
        ->get();                

        //* LINE CHART TRANSAKSI PEMBAYARAN
        $transaksiLine = Transaksi::select(
                DB::raw('MONTH(created_at) AS bulan'), DB::raw('SUM(pembayaran) AS jumlah_pembayaran'
            ))->whereBetween('created_at', [$startDate, $endDate])->groupBy('bulan')->get();  
        
        $month = $transaksiLine->pluck('bulan')->unique();
        
        $cek = count($transaksiLine->pluck('bulan')->unique());
        $MonthOrWeek = 'month';
        if ($cek <= 2) {
            $transaksiLine = Transaksi::select(
                DB::raw('WEEK(created_at) AS minggu'),
                DB::raw('SUM(pembayaran) AS jumlah_pembayaran')
            )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('minggu')
                ->get();
            $MonthOrWeek = 'week';
        }
        // dd($MonthOrWeek);

        //* BAR CHART                 
        $penjualanBarang = DB::table('transaksis')
            ->join('jual_tabung', 'transaksis.jual_tabung_id', '=', 'jual_tabung.id')
            ->join('barangs', 'jual_tabung.barangt_id', '=', 'barangs.id')
            ->select('barangs.nama_barang', DB::raw('MONTH(transaksis.created_at) as bulan'), DB::raw('SUM(transaksis.penebusan_tabung) as total'))
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->groupBy('barangs.nama_barang', 'bulan')
            ->get();        
        
        $barang = $penjualanBarang->pluck('nama_barang')->unique()->toArray();             
        $barang = array_values($barang);        
        $bulanData = $penjualanBarang->pluck('bulan')->unique()->toArray();
        $jmlBulan = count($bulanData);
        
        $data = array_fill($penjualanBarang->min('bulan')-1, $jmlBulan, array_fill(0, count($barang), 0));        

        // Memasukkan data ke dalam array sesuai dengan bulan dan barang
        foreach ($penjualanBarang as $penjualan) {
            $bulan = $penjualan->bulan - 1; // Karena array dimulai dari 0            
            $barangIndex = array_search($penjualan->nama_barang, $barang);            
            $data[$bulan][$barangIndex] = $penjualan->total;            
        }        
        // Cek dan isi nilai 0 pada index yang tidak terisi
        foreach ($data as $indexBulan => $bulanData) {
            foreach ($barang as $indexBarang => $namaBarang) {
                if (!isset($bulanData[$indexBarang])) {
                    $data[$indexBulan][$indexBarang] = 0;
                }
            }
        }        
        $data = array_values($data);         
        
        // * CARD INFO
        $stok = StokBarang::all();        
        $transaksi = Transaksi::whereDate('created_at', Carbon::now())->get();      
        $pembelianTabung = Pembelian_Tabung::whereDate('created_at', Carbon::now())->orWhereDate('updated_at', Carbon::now())->get();          
        // $bayarHutangTabung = Hutang::whereDate('updated_at', Carbon::now())->get();
        $bayarHutangTabung = TransaksiHutang::whereDate('created_at', Carbon::now())->get();
        $stok_isi_akhir = StokBarang::whereDate('updated_at', Carbon::now())->get()->count() == 0 ? 0 : $stok->sum('jumlah_stok_isi');
        $stok_kosong_akhir = StokBarang::whereDate('updated_at', Carbon::now())->get()->count() == 0 ? 0 : $stok->sum('jumlah_stok_kosong');
        
        $stok_kosong_awal = ($stok->sum('jumlah_stok_kosong') - $transaksi->sum('kembali_kabung') ?? 0) + $pembelianTabung->sum('barang_keluar_kosong') ?? 0;    
        $stok_kosong_awal = $stok_kosong_awal - $bayarHutangTabung->sum('bayar_hutang_tabung') ?? 0;        

        $stok_isi_awal = ($stok->sum('jumlah_stok_isi') + $transaksi->sum('penebusan_tabung') ?? 0) - $pembelianTabung->sum('barang_masuk_isi') ?? 0;

        $stokData = [
            'stok_isi_awal' => $stok_isi_awal,              
            'stok_kosong_awal' => $stok_kosong_awal,
            'stok_isi_akhir' => $stok_isi_akhir,
            'stok_kosong_akhir' => $stok_kosong_akhir
        ];

        

        return view('admin.index', compact('transaksiLine', 'data', 'barang', 'year', 'barangss', 'stokData', 'MonthOrWeek', 'month', 'star', 'end'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Hutang;
use App\Models\JualTabung;
use App\Models\Pangkalan;
use App\Models\StokBarang;
use App\Models\Transaksi;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $transaksi = Transaksi::latest()->get();
        $pangkalan = Pangkalan::latest()->get();

        return view('transaksi.penjualan_tabung.transaksi', compact('transaksi', 'pangkalan'));
    }

    public function addTransaksi()
    {
        $barang = JualTabung::join('barangs', 'barangs.id', '=', 'jual_tabung.barangt_id')
                     ->select('jual_tabung.*', 'barangs.nama_barang')
                     ->get();
        $pangkalan = Pangkalan::latest()->get();
        $nama_barang = Barang::latest()->get();

        return view('transaksi.penjualan_tabung.add_transaksi', compact('pangkalan', 'barang', 'nama_barang'));
    }

    public function Perhitungan($data)
    {   
        $jualTabung = JualTabung::findOrFail($data->jual_tabung_id);
        $dataStokBarang = StokBarang::where('barang_id', $jualTabung->barangt_id)->first();

        if($dataStokBarang->jumlah_stok_isi >= $data->penebusan_tabung){
            StokBarang::where('barang_id', $jualTabung->barang_id)->update([
                'jumlah_stok_isi' => ($dataStokBarang->jumlah_stok_isi - $data->penebusan_tabung),
                'jumlah_stok_kosong' => ($dataStokBarang->jumlah_stok_kosong + $data->kembali_tabung),
                'updated_at' => Carbon::now(),
            ]);
        }else{
            $notification = array(
                'message' => 'Stok Barang Habis',
                'alert-type' => 'warning',
            );
    
            return redirect()->route('transaksi.all')->with($notification);
            // return redirect()->back()->with($notification);
        }                       
    }

    public function storeTransaksi(Request $request)
    {                
        $validator = Validator::make($request->all(), [
            'penebusan_tabung' => 'required|numeric',
            'kembali_tabung' => 'required|numeric',
            'pembayaran' => 'required|numeric',
            'jual_tabung_id' => 'required',
            'pangkalan_id' => 'required',
        ], [
            'penebusan_tabung.required' => 'Jumlah penebusan harus diisi',
            'penebusan_tabung.numeric' => 'Jumlah penebusan harus diisi dengan angka',
            'kembali_tabung.required' => 'Jumlah kembali harus diisi', 
            'kembali_tabung.numeric' => 'Jumlah kembali harus diisi dengan angka', 
            'pembayaran.required' => 'Jumlah pembayaran harus diisi',
            'pembayaran.numeric' => 'Jumlah pembayaran harus diisi dengan angka',
            'jual_tabung_id.required' => 'Barang harus diisi',
            'pangkalan_id.required' => 'Pangkalan harus diisi',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jualTabung = JualTabung::findOrFail($request->jual_tabung_id);
        $dataStokBarang = StokBarang::where('barang_id', $jualTabung->barangt_id)->first();

        if($dataStokBarang->jumlah_stok_isi >= $request->penebusan_tabung){

            StokBarang::where('barang_id', $jualTabung->barangt_id)->update([
                'jumlah_stok_isi' => ($dataStokBarang->jumlah_stok_isi - $request->penebusan_tabung),
                'jumlah_stok_kosong' => ($dataStokBarang->jumlah_stok_kosong + $request->kembali_tabung),
                'updated_at' => Carbon::now(),
            ]);

            Transaksi::insert([
                'penebusan_tabung' => $request->penebusan_tabung,
                'kembali_kabung' => $request->kembali_tabung,
                'pembayaran' => $request->pembayaran,                
                'jual_tabung_id' => $request->jual_tabung_id,
                'pangkalan_id' => $request->pangkalan_id,
                'created_at' => Carbon::now(),
            ]);        
            
    
            if ($request->kembali_tabung < $request->penebusan_tabung || $request->pembayaran < $request->total_pembayaran) {
                $jualTabung = JualTabung::findOrFail($request->jual_tabung_id);
                $hutang = Hutang::where('barangss_id', $jualTabung->barangt_id)->where('pangkalan_id', $request->pangkalan_id)->first();            
    
                $totalKurangTabung = $request->penebusan_tabung - $request->kembali_tabung;
                $totalKurangPembayaran = $request->total_pembayaran - $request->pembayaran;
                if($hutang){                
                    $hutang->increment('hutang_tabung', $totalKurangTabung);
                    $hutang->increment('hutang_pembelian', $totalKurangPembayaran);
                    $hutang->touch(); // memperbarui updated_at
                }else{
                    Hutang::insert([
                        'hutang_tabung' => $totalKurangTabung,
                        'hutang_pembelian' => $totalKurangPembayaran,
                        'barangss_id' => $jualTabung->barangt_id,
                        'pangkalan_id' => $request->pangkalan_id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
            
            $notification = array(
                'message' => 'Transaksi Inserted Successfully',
                'alert-type' => 'success',
            );
    
            // return redirect()->route('transaksi.all')->with($notification);
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Stok Barang Habis',
                'alert-type' => 'warning',
            );
    
            return redirect()->route('transaksi.all')->with($notification);
            // return redirect()->back()->with($notification);
        }   
        // dd('hai');


        // Transaksi::insert([
        //     'penebusan_tabung' => $request->penebusan_tabung,
        //     'kembali_kabung' => $request->kembali_tabung,
        //     'pembayaran' => $request->pembayaran,                
        //     'jual_tabung_id' => $request->jual_tabung_id,
        //     'pangkalan_id' => $request->pangkalan_id,
        //     'created_at' => Carbon::now(),
        // ]);        
        

        // if ($request->kembali_tabung < $request->penebusan_tabung || $request->pembayaran < $request->total_pembayaran) {
        //     $jualTabung = JualTabung::findOrFail($request->jual_tabung_id);
        //     $hutang = Hutang::where('barangss_id', $jualTabung->barangt_id)->where('pangkalan_id', $request->pangkalan_id)->first();            

        //     $totalKurangTabung = $request->penebusan_tabung - $request->kembali_tabung;
        //     $totalKurangPembayaran = $request->total_pembayaran - $request->pembayaran;
        //     if($hutang){                
        //         $hutang->increment('hutang_tabung', $totalKurangTabung);
        //         $hutang->increment('hutang_pembelian', $totalKurangPembayaran);
        //         $hutang->touch(); // memperbarui updated_at
        //     }else{
        //         Hutang::insert([
        //             'hutang_tabung' => $totalKurangTabung,
        //             'hutang_pembelian' => $totalKurangPembayaran,
        //             'barangss_id' => $jualTabung->barangt_id,
        //             'pangkalan_id' => $request->pangkalan_id,
        //             'created_at' => Carbon::now(),
        //         ]);
        //     }
        // }
        
        // $notification = array(
        //     'message' => 'Transaksi Inserted Successfully',
        //     'alert-type' => 'success',
        // );

        // // return redirect()->route('transaksi.all')->with($notification);
        // return redirect()->back()->with($notification);
    }

    public function deleteTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $jualTabung = JualTabung::findOrFail($transaksi->jual_tabung_id);
        $hutang = Hutang::where('barangss_id', $jualTabung->barangt_id)->where('pangkalan_id', $transaksi->pangkalan_id)->first();
        if ($hutang) {            
            $totalKurangTabungs = $transaksi->penebusan_tabung - $transaksi->kembali_kabung;
            $totalKurangTabung = $hutang->hutang_tabung <=0 ? 0 : $totalKurangTabungs;

            $totalKurangPembayarans = $jualTabung->harga_jual * $transaksi->penebusan_tabung - $transaksi->pembayaran;            
            $totalKurangPembayaran = $hutang->hutang_pembelian <=0 ? 0 : $totalKurangPembayarans;            

            $hutang->decrement('hutang_tabung', $totalKurangTabung);
            $hutang->decrement('hutang_pembelian', $totalKurangPembayaran);
            $hutang->touch(); // memperbarui updated_at
        }

        $transaksi->delete();
        $notification = array(
            'message' => 'Transaksi Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }

    // ? LAPORAN
    public function laporanTransaksi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pangkalan' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'pangkalan.required' => 'Pangkalan harus dipilih',
            'start_date.required' => 'Tanggal harus diisi',
            'end_date.required' => 'Tanggal harus diisi',            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $startDate = $request->start_date;
        $endDate = date('Y-m-d', strtotime($request->end_date . ' +1 day'));
        $pangkalanId = $request->pangkalan;        

        $pangkalans = Pangkalan::where('id', $pangkalanId)
            ->with(['transaksis' => function($query) use ($startDate, $endDate) {
                $query->whereRaw("created_at >= '". $startDate ."' AND created_at <= '". $endDate ."'");
            }])->get();  
        
        $data = [
            'nama_pangkalan' => $pangkalans->first()->nama_pangkalan,
            'alamat' => $pangkalans->first()->alamat,
            'transaksis' => $pangkalans->first()->transaksis,
            'cek' => 1,
        ];
        // dd($data['transaksis']);        
        $pdf = FacadePdf::loadView('laporanInvoice', $data);
        ini_set('max_execution_time', 160);
        $pdf->setPaper('A4', 'landscape');    
        return $pdf->stream();                    
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pangkalans = Pangkalan::findOrFail($transaksi->pangkalan_id);
        $data = [
            'nama_pangkalan' => $pangkalans->nama_pangkalan,
            'alamat' => $pangkalans->alamat,
            'transaksis' => $transaksi,
            'cek' => 0,
        ];        
        $pdf = FacadePdf::loadView('laporanInvoice', $data);
        ini_set('max_execution_time', 160);
        $pdf->setPaper('A4', 'landscape');    
        return $pdf->stream();
    }    
}
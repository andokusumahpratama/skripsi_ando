<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian_Tabung;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class pembelianTabungController extends Controller
{
    public function orderTabung()
    {
        $listOrder = Pembelian_Tabung::latest()->get();
        // $barang = StokBarang::latest()->get();        
        $barang = StokBarang::with('barang')->latest()->get();   
        // dd($barang);
        return view('transaksi.pembelian_DO.orderTabung', compact('listOrder', 'barang'));
    }

    public function StorebeliTabung(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'barang_masuk_isi' => 'required|numeric',
            'barang_keluar_kosong' => 'required|numeric', 
            'tanggal_transaksi' => 'required|date',
            'barang_id' => 'required',
        ],[
            'barang_masuk_isi.required' => 'Jumlah barang masuk harus diisi',
            'barang_masuk_isi.numeric' => 'Jumlah barang harus angka',
            'barang_masuk_kosong.required' => 'Jumlah barang keluar harus diisi',
            'barang_masuk_kosong.numeric' => 'Jumlah barang harus angka',
            'barang_id.required' => 'Barang harus dipilih',
            'tanggal_transaksi.required' => 'Tanggal Harus diisi',
            'tanggal_transaksi.date' => 'Diisi dengan tanggal'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }        

        Pembelian_Tabung::insert([
            'barang_masuk_isi' => $request->barang_masuk_isi,
            'barang_keluar_kosong' => $request->barang_keluar_kosong,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'barangs_id' => $request->barang_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Pembelian barang Inserted Successfully',
            'alert-type' => 'success',
        );

        $this->Perhitungan($request);

        return redirect()->route('orderTabung.all')->with($notification);  
    }

    public function updateOrder(Request $request)
    {        
        $validator = Validator::make($request->all(),[
            'barang_masuk_isi' => 'required|numeric',
            'barang_keluar_kosong' => 'required|numeric', 
        ],[
            'barang_masuk_isi.required' => 'Jumlah barang masuk harus diisi',
            'barang_masuk_isi.numeric' => 'Jumlah barang harus angka',
            'barang_keluar_kosong.required' => 'Jumlah barang keluar harus diisi',
            'barang_keluar_kosong.numeric' => 'Jumlah barang harus angka',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->Perhitungan2($request);

        Pembelian_Tabung::findOrFail($request->id)->update([
            'barang_masuk_isi' => $request->barang_masuk_isi,
            'barang_keluar_kosong' => $request->barang_keluar_kosong,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'barangs_id' => $request->barang_id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Pembelian barang Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function deletePembelianDO($id)
    {
        Pembelian_Tabung::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Pembelian Tabung Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }

    public function Perhitungan($data)
    {        
        if ($data) {            
            $dataStokBarang = StokBarang::where('barang_id', $data->barang_id)->first();            
            StokBarang::where('barang_id', $data->barang_id)->update([
                'jumlah_stok_isi' => ($dataStokBarang->jumlah_stok_isi + $data->barang_masuk_isi),
                'jumlah_stok_kosong' => ($dataStokBarang->jumlah_stok_kosong - $data->barang_keluar_kosong),
                'created_at' => Carbon::now(),
            ]);           
        }        
    }

    public function Perhitungan2($data)
    {        
        $pembelianTabung = Pembelian_Tabung::findOrFail($data->id);     
           
        if ($data) {            
            $dataStokBarang = StokBarang::where('barang_id', $data->barang_id)->first();            
            StokBarang::where('barang_id', $data->barang_id)->update([
                'jumlah_stok_isi' => (($dataStokBarang->jumlah_stok_isi - $pembelianTabung->barang_masuk_isi) + $data->barang_masuk_isi),
                'jumlah_stok_kosong' => (($dataStokBarang->jumlah_stok_kosong + $pembelianTabung->barang_keluar_kosong) - $data->barang_keluar_kosong),
                'updated_at' => Carbon::now(),
            ]);           
        }        
    }
}

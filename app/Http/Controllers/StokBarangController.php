<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class StokBarangController extends Controller
{

    public function stokBarang()
    {
        $stokBarang = StokBarang::latest()->get();        

        return view('barang.stok.stokBarang', compact('stokBarang'));
    }
    
    public function addStokBarang()
    {
        $barang = Barang::select('id', 'nama_barang')->latest()->get();
        
        
        return view('barang.stok.add_stokBarang', compact('barang'));
    }

    public function storeStokBarang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'jumlah_stok_isi' => 'required|numeric',
            'jumlah_stok_kosong' => 'required|numeric',
            'barang_id' => 'required|unique:stok_barang,barang_id',
        ], [
            'jumlah_stok_isi.required' => 'Stok isi harus diisi.',
            'jumlah_stok_isi.numeric' => 'Stok isi harus diisi angka.',
            'jumlah_stok_kosong.required' => 'Stok kosong harus diisi.',
            'jumlah_stok_kosong.numeric' => 'Stok kosong harus diisi angka.',
            'barang_id.required' => 'Barang harus dipilih',
            'barang_id.unique' => 'Barang sudah dipilih',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        StokBarang::insert([
            'jumlah_stok_isi' => $request->jumlah_stok_isi,
            'jumlah_stok_kosong' => $request->jumlah_stok_kosong,
            'barang_id' => $request->barang_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Stok Barang Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('stokBarang.all')->with($notification);   
    }

    public function editStokBarang($id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        $barang = Barang::select('id', 'nama_barang')->latest()->get();

        return view('barang.stok.edit_stokBarang', compact('stokBarang', 'barang'));
    }

    public function updateStokBarang(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'jumlah_stok_isi' => 'required|numeric',
            'jumlah_stok_kosong' => 'required|numeric',
        ], [
            'jumlah_stok_isi.required' => 'Stok isi harus diisi.',
            'jumlah_stok_isi.numeric' => 'Stok isi harus diisi angka.',
            'jumlah_stok_kosong.required' => 'Stok kosong harus diisi.',
            'jumlah_stok_kosong.numeric' => 'Stok kosong harus diisi angka.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        StokBarang::findOrFail($request->id)->update([
            'jumlah_stok_isi' => $request->jumlah_stok_isi,
            'jumlah_stok_kosong' => $request->jumlah_stok_kosong,
            'barang_id' => $request->barang_id,
            // 'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Stok Barang updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('stokBarang.all')->with($notification);   
    }

    public function deleteStokBarang($id)
    {
        StokBarang::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Stok Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }
}

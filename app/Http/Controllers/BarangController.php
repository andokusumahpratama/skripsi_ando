<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JualTabung;
use App\Models\StokBarang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function barang()
    {
        $barang = Barang::latest()->get();        

        return view('barang.barang', compact('barang'));
    }

    public function addBarang()
    {
        return view('barang.add_barang');
    }

    public function storeBarang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required|unique:barangs,nama_barang',
            'harga_beli' => 'required|numeric',
        ], [
            'nama_barang.required' => 'Nama barang harus diisi.',
            'nama_barang.unique' => 'Barang Sudah Ada.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'harga_beli.numeric' => 'Harga beli harus diisi angka.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Barang::insert([
        //     'nama_barang' => $request->nama_barang,
        //     'harga_beli' => $request->harga_beli,
        //     'created_at' => Carbon::now(),
        // ]);

        // Insert data ke tabel Barang dan ambil id-nya
        $barangId = Barang::insertGetId([
            'nama_barang' => $request->nama_barang,
            'harga_beli' => $request->harga_beli,
            'created_at' => Carbon::now(),
        ]);

        // Insert data ke tabel StokBarang dengan menggunakan id yang didapat sebelumnya
        // StokBarang::insert([
        //     'jumlah_stok_isi' => 0,
        //     'jumlah_stok_kosong' => 0,
        //     'barang_id' => $barangId,
        //     'created_at' => Carbon::now(),
        // ]);

        $notification = array(
            'message' => 'Barang Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('barang.all')->with($notification);
    }

    public function editBarang($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit_barang', compact('barang'));
    }

    public function updateBarang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual.*' => 'required|numeric',
        ], [
            'nama_barang.required' => 'Nama barang harus diisi.',
            'harga_beli.required' => 'Harga beli harus diisi.',
            'harga_beli.numeric' => 'Harga beli harus diisi angka.',
            'harga_jual.*.required' => 'Harga jual harus diisi.',
            'harga_jual.*.numeric' => 'Harga jual harus diisi angka.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $harga_jual = $request->input('harga_jual');        

        for ($i=0; $i <= count($harga_jual); $i++) { 
            JualTabung::where('id', $request->input('id_jual.'.$i))
                ->where('harga_jual', '!=', $request->input('harga_jual.'.$i))
                ->update(['harga_jual' => $request->input('harga_jual.'.$i)]);            
            }               
        
        Barang::findOrFail($request->id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_beli' => $request->harga_beli,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Barang Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('barang.all')->with($notification);
    }

    public function deleteBarang($id)
    {
        $jualTabung = JualTabung::where('barangt_id',$id)->get();
        foreach ($jualTabung as $value) {
            var_dump($value->id);
            JualTabung::findOrFail($value->id)->delete();
        }        
        // dd($id);
        // $JualBarang = JualTabung::where('barangt_id', $id)->get();
        // $transaksis = Transaksi::where('jual_tabung_id', $JualBarang->id)->get();        
        // $transaksis->delete();
        // $JualBarang->delete();     
        Barang::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Barang Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }

    public function addHargaBarang()
    {
        $barang = Barang::select('id', 'nama_barang')->latest()->get();
        return view('barang.add_Hargabarang', compact('barang'));
    }

    public function storeHargaBarang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'harga_jual' => 'required|numeric',
            'barang_id' => 'required',
        ], [
            'harga_jual.required' => 'Harga beli harus diisi.',
            'harga_jual.numeric' => 'Harga beli harus diisi angka.',
            'barang_id.numeric' => 'Barang harus dipilih'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        JualTabung::insert([
            'harga_jual' => $request->harga_jual,
            'barangt_id' => $request->barang_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Barang Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('barang.all')->with($notification);   
    }

    public function deleteHargaBarang($id)
    {
        JualTabung::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Barang Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }    
}

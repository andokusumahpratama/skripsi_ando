<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Pangkalan;
use App\Models\StokBarang;
use App\Models\TransaksiHutang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PangkalanController extends Controller
{
    public function pangkalan()
    {
        $pangkalan = Pangkalan::latest()->get();
        return view('admin.SDM.pangkalan.pangkalan', compact('pangkalan'));
    }

    public function addPangkalan()
    {
        return view('admin.SDM.pangkalan.add_pangkalan');
    }

    public function storePangkalan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pangkalan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ], [
            'nama_pangkalan.required' => 'Nama Pangkalan harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.required' => 'Nomor handphone harus diisi',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pangkalan::insert([
            'nama_pangkalan' => $request->nama_pangkalan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        $notification = array(
            'message' => 'Pangkalan Inserted Successfully',
            'alert-type' => 'success',
        );

        // return redirect()->route('pangkalan.all')->with($notification);
        return redirect()->back()->with($notification);
    }

    public function editPangkalan($id)
    {
        $pangkalan = Pangkalan::findOrFail($id);

        return view('admin.SDM.pangkalan.edit_pangkalan', compact('pangkalan'));
    }

    public function updatePangkalan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pangkalan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ], [
            'nama_pangkalan.required' => 'Nama Pangkalan harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.required' => 'Nomor handphone harus diisi',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pangkalan::findOrFail($request->id)->update([
            'nama_pangkalan' => $request->nama_pangkalan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        $notification = array(
            'message' => 'Pangkalan Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('pangkalan.all')->with($notification);
    }

    public function deletePangkalan($id)
    {
        Pangkalan::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Pangkalan Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }

    public function detailPangkalan($id)
    {
        $pangkalan  = Pangkalan::findOrFail($id);
        $hutang = Hutang::where('pangkalan_id', $id)->get();
        
        return view('admin.SDM.pangkalan.detail_pangkalan', compact('pangkalan', 'hutang'));
    }

    public function bayarPangkalan($id)
    {
        $hutang = Hutang::findOrFail($id);

        return view('admin.SDM.pangkalan.bayar', compact('hutang'));
    }

    public function updateBayarPangkalan(Request $request)
    {
        $dataHutang = Hutang::findOrFail($request->id);
        $h_bayarPembelian = $dataHutang->hutang_pembelian - $request->hutang_pembelian;
        $h_bayarTabung = $dataHutang->hutang_tabung - $request->hutang_tabung;

        if ($dataHutang->hutang_pembelian != $request->hutang_pembelian || $dataHutang->hutang_tabung != $request->hutang_tabung) {                        
            TransaksiHutang::insert([
                'bayar_hutang_pembelian' => $h_bayarPembelian,
                'bayar_hutang_tabung' => $h_bayarTabung,
                'pangkalans__id' => $request->pangkalan_id,
                'barangs__id' => $request->barang_id,
                'created_at' => Carbon::now(),
            ]);
        }

        Hutang::findOrFail($request->id)->update([
            'hutang_tabung' => $request->hutang_tabung,
            'hutang_pembelian' => $request->hutang_pembelian
        ]);

        $StokBarang = StokBarang::where('barang_id', $request->barang_id);
        $StokBarang->increment('jumlah_stok_kosong', $h_bayarTabung);
        $StokBarang->touch(); // memperbarui updated_at        

        $notification = array(
            'message' => 'Bayar Hutang Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('detail.pangkalan', $request->pangkalan_id)->with($notification);
    }

    public function riwayatBayarHutang($pangakalan_id)
    {
        $riwayat = TransaksiHutang::where('pangkalans__id', $pangakalan_id)->get();
        // dd($riwayat);
        return view('admin.SDM.pangkalan.riwayat_pembayaranHutang', compact('riwayat'));
    }

    public function hapusRiwayat($id)
    {
        TransaksiHutang::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Riwayat Pembayaran Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class AkunController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    }

    public function karyawan()
    {
        $karyawan = Karyawan::latest()->get();

        return view('admin.SDM.karyawan.karyawan', compact('karyawan'));
    }

    public function addKaryawan()
    {
        $jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        return view('admin.SDM.karyawan.add_karyawan', compact('jabatan'));
    }

    public function storeKaryawan(Request $request)
    {
        // $request->validate([
        //     'nama_karyawan' => 'required',
        //     'email' => 'required|email|unique:karyawans,user_email',
        //     'password' => 'required',
        //     'tanggal_lahir' => 'required'
        // ], [
        //     'nama_karyawan.required' => 'Nama harus diisi.',
        //     'email.required' => 'Email harus diisi.',
        //     'email.email' => 'Format email tidak valid.',
        //     'email.unique' => 'Email sudah digunakan.',
        //     'password.required' => 'Password harus diisi',
        //     'tanggal_lahir.required' => 'Tanggal lahir harus diisi', 
        // ]);

        $validator = Validator::make($request->all(),[
            'nama_karyawan' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'tanggal_lahir' => 'required'
        ], [
            'nama_karyawan.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi', 
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $password_hash = Hash::make($request->password);

        // * User
        User::insert([
            'email' => $request->email,
            'password' => $password_hash,
            'created_at' => Carbon::now(),
        ]);

        $user_id = User::where('email', $request->email)->first();

        if ($request->file('profile_image')) {
            $image = $request->file('profile_image');        
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();            
            $image->move(public_path('upload/admin_image'), $name_gen);
            $save_url = 'upload/admin_image/'.$name_gen;                        
            
            // * KARYAWAN
            Karyawan::insert([
                'nama_karyawan' => $request->nama_karyawan,                              
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan' => $request->pendidikan,
                'jabatan_id' => $request->jabatan,
                'user_id' => $user_id->id,  
                'created_at' => Carbon::now(),
                'profile_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Karyawan Inserted Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('karyawan.all')->with($notification);   
        }else{

            // * KARYAWAN
            Karyawan::insert([
                'nama_karyawan' => $request->nama_karyawan,                
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan' => $request->pendidikan,
                'jabatan_id' => $request->jabatan,
                'user_id' => $user_id->id,  
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Karyawan Inserted without Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('karyawan.all')->with($notification);         
        }
    }

    public function editKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        return view('admin.SDM.karyawan.edit_karyawan', compact('karyawan', 'jabatan'));

    }

    public function updateKaryawan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_karyawan' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required'
        ], [
            'nama_karyawan.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi', 
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $karyawan_id = $request->id;
        $data_karyawan = Karyawan::findOrFail($karyawan_id);
        $data_akun = User::findOrFail($data_karyawan->user_id);

        if($data_akun->email != $request->email){

            $validator_email_unique = Validator::make($request->all(),[
                'email' => 'unique:users,email',
            ], [
                'email.unique' => 'Email sudah digunakan.',
            ]);
    
            if($validator_email_unique->fails()){
                return redirect()->back()->withErrors($validator_email_unique)->withInput();
            }

            // * User
            User::findOrFail($request->user_id)->update([
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ]);
        }        

        if ($request->file('profile_image')) {

            $imagePathOlder = $data_karyawan->profile_image;

            if(File::exists($imagePathOlder)) {
                File::delete($imagePathOlder);
            }
            
            $image = $request->file('profile_image');        
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();            
            $image->move(public_path('upload/admin_image'), $name_gen);
            $save_url = 'upload/admin_image/'.$name_gen;
            
            // * KARYAWAN
            Karyawan::findOrFail($karyawan_id)->update([
                'nama_karyawan' => $request->nama_karyawan,
                'user_id' => $request->user_id,                
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan' => $request->pendidikan,
                'jabatan_id' => $request->jabatan,
                'updated_at' => Carbon::now(),
                'profile_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Karyawan Inserted Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('karyawan.all')->with($notification);   
        }else{
            // * KARYAWAN
            Karyawan::findOrFail($karyawan_id)->update([
                'nama_karyawan' => $request->nama_karyawan,
                'user_id' => $request->user_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan' => $request->pendidikan,
                'jabatan_id' => $request->jabatan,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Karyawan Inserted without Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('karyawan.all')->with($notification);
        }
    }


    public function deleteKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $akun_karyawan = User::findOrFail($karyawan->user_id);
        $karyawan_image = $karyawan->profile_image;
        unlink($karyawan_image);

        Karyawan::findOrFail($id)->delete();
        User::findOrFail($akun_karyawan->id)->delete();

        $notification = array(
            'message' => 'Data Karyawan Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('admin.SDM.karyawan.karyawan_change_password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hasPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hasPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password updated successfully');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old Password is not match');
            return redirect()->back();
        }
    }
}

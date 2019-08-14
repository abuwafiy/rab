<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Jabatan;

class LoginController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'Login'; 
        $this->view = view('pages.login.index');
        return $this->generateView(); 
    }
    public function attempt(Request $request){
    	$nik = $request->nik;
	    $password = $request->password;
         $karyawan = Karyawan::where('nik', $nik)->where('password', $password)->first();
        if(isset($karyawan->nik) && $karyawan->nik == $nik && $karyawan->password == $password){
           
            $jabatan = Jabatan::find($karyawan->id_jabatan);
            session(['nik' => $karyawan->nik, 'nama_karyawan' => $karyawan->nama_karyawan, 'jabatan' => $jabatan->id_jabatan]);
            return redirect('dashboard');
        }else{
        	return redirect('/')->with(['error' => 'Username atau Password anda salah']);
        }
    }
    public function destroy(){
    	session()->flush();
		return redirect('/');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Karyawan;
use DB;


class KaryawanController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'karyawan'; 
    	$karyawan = DB::select('SELECT * FROM KARYAWAN A JOIN JABATAN B ON A.ID_JABATAN = B.ID_JABATAN');
        $this->view = view('pages.karyawan.index',compact('karyawan'));
        return $this->generateView(); 
    }

    public function create(){
    	$this->page_attributes->title = 'Tambah karyawan'; 
        $jabatan = jabatan::get();
        $this->view = view('pages.karyawan.add',compact('jabatan'));
        return $this->generateView(); 

    }

    public function store(Request $request){
    	$karyawan = new Karyawan();
    	$karyawan->fill($request->all());
    	$karyawan->save();
    	return redirect('karyawan');
    }

    public function edit($id){
    	$this->page_attributes->title = 'Edit karyawan'; 
         $jabatan = jabatan::get();
    	$karyawan = karyawan::find($id);
        $this->view = view('pages.karyawan.edit',compact('karyawan','jabatan'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
    	$karyawan = karyawan::find($id);
    	$karyawan->fill($request->all());
    	$karyawan->save();
    	return redirect('karyawan');
    }


    public function destroy($id){
        $karyawan = karyawan::find($id)->delete();
    }
}

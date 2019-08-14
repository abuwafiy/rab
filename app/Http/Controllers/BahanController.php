<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\Satuan;
use Yajra\DataTables\DataTables;
use DB;


class BahanController extends Controller
{
    public function index(){
        $this->page_attributes->title = 'Nama Bahan'; 
        $bahan = Bahan::get();
        $this->view = view('pages.bahan.index',compact('bahan'));
        return $this->generateView(); 
    }

    public function create(){
        $this->page_attributes->title = 'Tambah Nama Bahan'; 
        $satuan = Satuan::get();
        $this->view = view('pages.bahan.add',compact('satuan'));
        return $this->generateView(); 

    }

    public function store(Request $request){
        $bahan = new bahan();
        $bahan->fill($request->all());
        $bahan->save();
        return redirect('bahan');
    }

    public function edit($id){
        $this->page_attributes->title = 'Edit Bahan'; 
        $satuan= Satuan::get();
        $bahan = bahan::find($id);
        $this->view = view('pages.bahan.edit',compact('bahan','satuan'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
        $bahan = bahan::find($id);
        $bahan->fill($request->all());
        $bahan->save();
        return redirect('bahan');
    }


    public function destroy($id){
        $bahan = bahan::find($id)->delete();
    }

    public function get_data(){
        $bahan = Bahan::get();
         return Datatables::of($bahan)->make(true);
    }
}

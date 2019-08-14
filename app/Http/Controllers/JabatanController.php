<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;


class JabatanController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'jabatan'; 
    	$jabatan = jabatan::get();
        $this->view = view('pages.jabatan.index',compact('jabatan'));
        return $this->generateView(); 
    }

    public function create(){
    	$this->page_attributes->title = 'Tambah jabatan'; 
        $this->view = view('pages.jabatan.add');
        return $this->generateView(); 
    }

    public function store(Request $request){
    	$jabatan = new jabatan();
    	$jabatan->fill($request->all());
    	$jabatan->save();
    	return redirect('jabatan');
    }

    public function edit($id){
    	$this->page_attributes->title = 'Edit jabatan'; 
    	$jabatan = jabatan::find($id);
        $this->view = view('pages.jabatan.edit',compact('jabatan'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
    	$jabatan = jabatan::find($id);
    	$jabatan->fill($request->all());
    	$jabatan->save();
    	return redirect('jabatan');
    }


    public function destroy($id){
        $jabatan = jabatan::find($id)->delete();
    }
}

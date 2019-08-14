<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'Kategori'; 
    	$kategori = Kategori::get();
        $this->view = view('pages.kategori.index',compact('kategori'));
        return $this->generateView(); 
    }

    public function create(){
    	$this->page_attributes->title = 'Tambah Kategori'; 
        $this->view = view('pages.kategori.add');
        return $this->generateView(); 
    }

    public function store(Request $request){
    	$kategori = new Kategori();
    	$kategori->fill($request->all());
    	$kategori->save();
    	return redirect('kategori');
    }

    public function edit($id){
    	$this->page_attributes->title = 'Edit Kategori'; 
    	$kategori = Kategori::find($id);
        $this->view = view('pages.kategori.edit',compact('kategori'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
    	$kategori = Kategori::find($id);
    	$kategori->fill($request->all());
    	$kategori->save();
    	return redirect('kategori');
    }

    public function destroy($id){
    	$kategori = Kategori::find($id)->delete();
    }
}

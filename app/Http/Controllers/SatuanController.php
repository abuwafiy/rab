<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'Satuan'; 
    	$satuan = Satuan::get();
        $this->view = view('pages.satuan.index',compact('satuan'));
        return $this->generateView(); 
    }

    public function create(){
    	$this->page_attributes->title = 'Tambah Satuan'; 
        $this->view = view('pages.satuan.add');
        return $this->generateView(); 
    }

    public function store(Request $request){
    	$satuan = new Satuan();
    	$satuan->fill($request->all());
    	$satuan->save();
    	return redirect('satuan');
    }

    public function edit($id){
    	$this->page_attributes->title = 'Edit Satuan'; 
    	$satuan = Satuan::find($id);
        $this->view = view('pages.satuan.edit',compact('satuan'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
    	$satuan = Satuan::find($id);
    	$satuan->fill($request->all());
    	$satuan->save();
    	return redirect('satuan');
    }

    public function destroy($id){
    	$satuan = Satuan::find($id)->delete();
    }
}

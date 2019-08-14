<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;


class ProyekController extends Controller
{
    public function index(){
    	$this->page_attributes->title = 'Proyek'; 
    	$proyek = Proyek::get();
        $this->view = view('pages.proyek.index',compact('proyek'));
        return $this->generateView(); 
    }

    public function create(){
    	$this->page_attributes->title = 'Tambah Proyek'; 
        $this->view = view('pages.proyek.add');
        return $this->generateView(); 
    }

    public function store(Request $request){
    	$proyek = new Proyek();
    	$proyek->fill($request->all());
    	$proyek->save();
    	return redirect('proyek');
    }

    public function edit($id){
    	$this->page_attributes->title = 'Edit Proyek'; 
    	$proyek = Proyek::find($id);
        $this->view = view('pages.proyek.edit',compact('proyek'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
    	$proyek = Proyek::find($id);
    	$proyek->fill($request->all());
    	$proyek->save();
    	return redirect('proyek');
    }

    public function destroy($id){
    	$proyek = Proyek::find($id)->delete();
    }
}

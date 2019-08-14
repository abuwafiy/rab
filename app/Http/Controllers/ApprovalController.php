<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Pengajuan;
use App\Models\Rab;
// use App\Models\Satuan;
use App\Models\Kategori;
// use App\Models\Detailpengajuan;
// use App\Models\DetailBahan;
use Yajra\DataTables\DataTables;
use DB;


class ApprovalController extends Controller
{
    public function index(){
        $this->page_attributes->title = 'Pengajuan Tambah Bahan '; 
        $pengajuan = DB::select('SELECT * FROM pengajuan_tambah_bahan A JOIN proyek B ON A.ID_PROYEK = B.ID_PROYEK JOIN rab C ON A.ID_RAB = C.ID_RAB JOIN kategori D ON A.ID_KATEGORI = D.ID_KATEGORI');
        $this->view = view('pages.approval.index',compact('pengajuan'));
        return $this->generateView(); 
    }


    public function create(){
        $this->page_attributes->title = 'Tambah Pengajuan Bahan';  
        $proyek = Proyek::get();
        $rab=rab::get();
        $kategori=kategori::get();
        $this->view = view('pages.approval.add',compact('proyek','rab','kategori'));
        return $this->generateView(); 

    }

    public function store(Request $request){
        $pengajuan = new pengajuan();
        $pengajuan->fill($request->all());
        $pengajuan->save();
        return redirect('approval');
    }

    public function edit($id){
        $this->page_attributes->title = 'Approval Pengajuan'; 
        $proyek = proyek::get();
        $rab = rab::get();
        $kategori = kategori::get();
        $pengajuan = pengajuan::find($id);
        $this->view = view('pages.approval.edit',compact('pengajuan','proyek','rab','kategori'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
        $pengajuan = pengajuan::find($id);
        $pengajuan->fill($request->all());
        $pengajuan->save();
        return redirect('approval');
    }


    public function destroy($id){
        $pengajuan = pengajuan::find($id)->delete();
        // $pengajuan = pengajuan::where('id_pengajuan',$id)->get();
        // foreach ($detailpengajuan as $key => $value) {
        //     $detailbahan = DetailBahan::where('id_detail_pengajuan',$value->id_detail_pengajuan)->delete();
        // }
        // $detailpengajuan = Detailpengajuan::where('id_pengajuan',$id)->delete();
        // $pengajuan = pengajuan::find($id)->delete();
        
    }
}

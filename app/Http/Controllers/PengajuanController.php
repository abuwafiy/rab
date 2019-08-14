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


class PengajuanController extends Controller
{
    public function index(){
        $this->page_attributes->title = 'Pengajuan Tambah Bahan '; 
        $pengajuan = DB::select('SELECT * FROM pengajuan_tambah_bahan A JOIN proyek B ON A.ID_PROYEK = B.ID_PROYEK JOIN rab C ON A.ID_RAB = C.ID_RAB JOIN kategori D ON A.ID_KATEGORI = D.ID_KATEGORI');
        $this->view = view('pages.pengajuan.index',compact('pengajuan'));
        return $this->generateView(); 
    }


    public function create(Request $request){
        $this->page_attributes->title = 'Tambah Pengajuan Bahan';
        $proyek = proyek::get();
        // $pilih = self::pilihPro($request);  
        // $pilih =DB::table("SELECT nama_proyek a, nama_rab b FROM proyek a JOIN rab b on a.id_proyek = b.id_proyek WHERE a.id_proyek = b.id_proyek and status = 'aktif'");
         // $proyek = DB::select("SELECT nama_proyek a, nama_rab b FROM proyek a JOIN rab b on a.id_proyek = b.id_proyek WHERE a.id_proyek = b.id_proyek ");
        $rab=rab::get();
        $kategori=kategori::get();
        $this->view = view('pages.pengajuan.add',compact('proyek','rab','kategori','pilih'));
        return $this->generateView(); 

    }

    // public function pilihPro(Request $request){
    //     $pilih =DB::select("SELECT nama_proyek a, nama_rab b FROM proyek a JOIN rab b on a.id_proyek = b.id_proyek WHERE a.id_proyek = $request->id_proyek and status = 'aktif'");
    //    return $pilih;
    // }

    public function store(Request $request){
        $pengajuan = new pengajuan();
        $pengajuan->fill($request->all());
        $pengajuan->save();
        return redirect('pengajuan');
    }

    public function edit($id){
        $this->page_attributes->title = 'Edit Pengajuan'; 
        $proyek = proyek::get();
        $rab = rab::get();
        $kategori = kategori::get();
        $pengajuan = pengajuan::find($id);
        $this->view = view('pages.pengajuan.edit',compact('pengajuan','proyek','rab','kategori'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
        $pengajuan = pengajuan::find($id);
        $pengajuan->fill($request->all());
        $pengajuan->save();
        return redirect('pengajuan');
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

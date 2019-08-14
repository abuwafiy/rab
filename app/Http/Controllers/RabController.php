<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Rab;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\DetailRab;
use App\Models\DetailBahan;
use Yajra\DataTables\DataTables;
use DB;


class RabController extends Controller
{
    public function index(){
        $this->page_attributes->title = 'Rencana Anggaran Biaya'; 
        $rab = DB::select('SELECT * FROM rab A JOIN proyek B ON A.ID_PROYEK = B.ID_PROYEK');
        $this->view = view('pages.rab.index',compact('rab'));
        return $this->generateView(); 
    }

    public function create(){
        $this->page_attributes->title = 'Tambah Rencana Anggaran Biaya'; 
        $this->page_attributes->icon = 'Tambah Rencana Anggaran Biaya'; 
        $proyek = DB::select("SELECT * FROM proyek where status ='aktif '");
        $this->view = view('pages.rab.add',compact('proyek'));
        return $this->generateView(); 

    }

    public function show(Request $request, $id){
        $rab = Rab::where('rab.id_rab',$id)->leftJoin('proyek', 'proyek.id_proyek','=','rab.id_proyek')->first();
        $kategori = Kategori::get();
        $satuan = Satuan::get();
        $this->page_attributes->title = 'Tambah Detail RAB';
        $this->view = view('pages.rab.detailrab', compact('rab','kategori','satuan'));
        return $this->generateView(); 
    }

    public function store(Request $request){
        $rab = new Rab();
        $rab->fill($request->all());
        $rab->save();
        return redirect('rab');
    }

    public function edit($id){
        $this->page_attributes->title = 'Edit Rencana Anggaran Biaya'; 
        $proyek = proyek::get();
        $rab = rab::find($id);
        $this->view = view('pages.rab.edit',compact('rab','proyek'));
        return $this->generateView(); 
    }

    public function update(Request $request, $id){
        $rab = rab::find($id);
        $rab->fill($request->all());
        $rab->save();
        return redirect('rab');
    }


    public function destroy($id){
        $detailrab = DetailRab::where('id_rab',$id)->get();
        foreach ($detailrab as $key => $value) {
            $detailbahan = DetailBahan::where('id_detail_rab',$value->id_detail_rab)->delete();
        }
        $detailrab = DetailRab::where('id_rab',$id)->delete();
        $rab = rab::find($id)->delete();
        
    }

    public function get_data(Request $request){
        $detailrab = DB::select("SELECT *, DATEDIFF(tanggal_selesai,tanggal_mulai) AS durasi,IFNULL((SELECT SUM(VOLUME*HARGA) FROM detail_bahan WHERE id_detail_rab = A.id_detail_rab),0) as harga_satuan, volume_rab,satuan_rab,volume_rab*IFNULL((SELECT SUM(VOLUME*HARGA) FROM detail_bahan WHERE id_detail_rab = A.id_detail_rab),0) as biaya FROM DETAIL_RAB A WHERE ID_RAB = $request->id_rab and ID_KATEGORI = $request->id_kategori");
        return Datatables::of($detailrab)->addColumn('action', function ($detailrab) {
            return '<a href="" class="button" data-id="'.$detailrab->id_rab.'"><i class="glyphicon glyphicon-repeat"></i> Cancel</a>';
        })
        ->make(true);
    }

    public function get_datas(Request $request){
        $detailrab = DB::select("SELECT D.ID_KATEGORI,F.NAMA_KATEGORI FROM DETAIL_RAB D JOIN Kategori F ON D.ID_KATEGORI=F.ID_KATEGORI left JOIN detail_bahan E ON E.id_detail_rab=D.id_detail_rab where id_rab = $request->id_rab GROUP BY D.id_kategori,F.nama_kategori");
        return Datatables::of($detailrab)->make(true);
    }

    public function getDetail(Request $request){
        $detailrab = DB::select("SELECT * FROM DETAIL_RAB A JOIN Kategori B ON A.ID_KATEGORI=B.ID_KATEGORI where a.id_detail_rab = $request->id_detail_rab");
        return response()->json($detailrab[0]);
    }

    public function storeDetail(Request $request){
        $detailrab = new DetailRab();
        $detailrab->fill($request->all());
        $detailrab->save();
        return response()->json(['msg'=>'success']);
    }

    public function storeDetailBahan(Request $request){
        $detailrab = DetailRab::find($request->id_detail_rab);
        $detailrab->fill($request->all());
        $detailrab->save();
        if(isset($request->data)){
        foreach ($request->data as $key => $value) {
            if($value['id_detail_bahan'] == -1){
                $detailrab = new DetailBahan();
                $id_detail_bahan = DB::select("SELECT IFNULL(MAX(id_detail_bahan),0)+1 AS id_detail_bahan FROM detail_bahan");
                $detailrab->id_detail_bahan = $id_detail_bahan[0]->id_detail_bahan;
                $detailrab->id_detail_rab = $request->id_detail_rab;
                $detailrab->id_bahan = $value['id_bahan'];
                $detailrab->volume = $value['volume'];
                $detailrab->satuan = $value['satuan'];
                $detailrab->harga = $value['harga'];
                $detailrab->save();
            }else{
                $detailrab = DetailBahan::find($value['id_detail_bahan']);
                $detailrab->id_bahan = $value['id_bahan'];
                $detailrab->volume = $value['volume'];
                $detailrab->satuan = $value['satuan'];
                $detailrab->harga = $value['harga'];
                $detailrab->save();
            }
        }
    }
        return response()->json(['msg' => 'success']);
    }

    public function destroyDetailBahan($id){
        $detail = DetailBahan::find($id);
        $detailbahan = DetailBahan::find($id)->delete();
        return response()->json($detail);
    }

    public function getDetailBahan(Request $request){
        $detailbahan = DB::select("SELECT * FROM detail_bahan A JOIN BAHAN B ON A.id_bahan=B.id_bahan WHERE id_detail_rab = $request->id_detail_rab");
        return response()->json($detailbahan);
    }

    public function destroyDetail($id){
        $detailrab = DetailRab::find($id)->delete();
        $detailbahan = DetailBahan::where('id_detail_rab',$id)->delete();
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Realisasi;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Rab;
use App\Models\DetailRab;
use App\Models\DetailBahanRealisasi;
use Yajra\DataTables\DataTables;
use DB;


class RealisasiController extends Controller
{
    public function index(){
        $this->page_attributes->title = 'Realisasi Proyek'; 
        $realisasi = DB::select('SELECT * FROM rab A JOIN proyek B ON A.ID_PROYEK = B.ID_PROYEK');
        $this->view = view('pages.realisasi.index',compact('realisasi'));
        return $this->generateView(); 
    }

    public function show(Request $request, $id){
        $rab = Rab::where('rab.id_rab',$id)->leftJoin('proyek', 'proyek.id_proyek','=','rab.id_proyek')->first();
        $kategori = Kategori::get();
        $satuan = Satuan::get();
        $this->page_attributes->title = 'Realisasi Proyek';
        $this->view = view('pages.realisasi.detailrealisasi', compact('rab','kategori','satuan'));
        return $this->generateView(); 
    }

    public function store(Request $request){
        try{
            $id_detail_realisasi = DB::select("SHOW TABLE STATUS LIKE 'DETAIL_REALISASI'");
            $id_detail_realisasi = $id_detail_realisasi[0]->Auto_increment;
            $detailrealisasi = new Realisasi();
            $detailrealisasi->kegiatan = $request->kegiatan;
            $detailrealisasi->id_kategori = $request->id_kategori;
            $detailrealisasi->id_detail_rab = $request->id_detail_rab;
            $detailrealisasi->volume_realisasi = $request->volume_realisasi;
            $detailrealisasi->satuan_realisasi = $request->satuan_realisasi;
            $detailrealisasi->tanggal_mulai = $request->tanggal_mulai;
            $detailrealisasi->tanggal_selesai = $request->tanggal_selesai;
            $detailrealisasi->persentase = $request->persentase;
            $detailrealisasi->save();
            if(isset($request->data)){
                foreach ($request->data as $key => $value) {
                    if($value['id_detail_bahan_realisasi'] == -1){
                        $detailbahanrealisasi = new DetailBahanRealisasi();
                        $id_detail_bahan_realisasi = DB::select("SELECT IFNULL(MAX(id_detail_bahan_realisasi),0)+1 AS id_detail_bahan_realisasi FROM detail_bahan_realisasi");
                        $detailbahanrealisasi->id_detail_bahan_realisasi = $id_detail_bahan_realisasi[0]->id_detail_bahan_realisasi;
                        $detailbahanrealisasi->id_detail_realisasi = $id_detail_realisasi;
                        $detailbahanrealisasi->id_bahan = $value['id_bahan'];
                        $detailbahanrealisasi->volume = $value['volume'];
                        $detailbahanrealisasi->satuan = $value['satuan'];
                        $detailbahanrealisasi->harga = $value['harga'];
                        $detailbahanrealisasi->save();
                    }else{
                        $detailbahanrealisasi = DetailBahanRealisasi::find($value['id_detail_bahan_realisasi']);
                        $detailbahanrealisasi->id_bahan = $value['id_bahan'];
                        $detailbahanrealisasi->volume = $value['volume'];
                        $detailbahanrealisasi->satuan = $value['satuan'];
                        $detailbahanrealisasi->harga = $value['harga'];
                        $detailbahanrealisasi->save();
                    }
                }
            }
        }catch(\Exception $e){
            return response()->json(['msg' =>$e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try{
            $detailrealisasi = Realisasi::find($id);
            $detailrealisasi->volume_realisasi = $request->volume_realisasi;
            $detailrealisasi->satuan_realisasi = $request->satuan_realisasi;
            $detailrealisasi->tanggal_mulai = $request->tanggal_mulai;
            $detailrealisasi->tanggal_selesai = $request->tanggal_selesai;
            $detailrealisasi->persentase = $request->persentase;
            $detailrealisasi->save();
            if(isset($request->data)){
                foreach ($request->data as $key => $value) {
                    if($value['id_detail_bahan_realisasi'] == -1){
                        $detailbahanrealisasi = new DetailBahanRealisasi();
                        $id_detail_bahan_realisasi = DB::select("SELECT IFNULL(MAX(id_detail_bahan_realisasi),0)+1 AS id_detail_bahan_realisasi FROM detail_bahan_realisasi");
                        $detailbahanrealisasi->id_detail_bahan_realisasi = $id_detail_bahan_realisasi[0]->id_detail_bahan_realisasi;
                        $detailbahanrealisasi->id_detail_realisasi = $id;
                        $detailbahanrealisasi->id_bahan = $value['id_bahan'];
                        $detailbahanrealisasi->volume = $value['volume'];
                        $detailbahanrealisasi->satuan = $value['satuan'];
                        $detailbahanrealisasi->harga = $value['harga'];
                        $detailbahanrealisasi->save();
                    }else{
                        $detailbahanrealisasi = DetailBahanRealisasi::find($value['id_detail_bahan_realisasi']);
                        $detailbahanrealisasi->id_bahan = $value['id_bahan'];
                        $detailbahanrealisasi->volume = $value['volume'];
                        $detailbahanrealisasi->satuan = $value['satuan'];
                        $detailbahanrealisasi->harga = $value['harga'];
                        $detailbahanrealisasi->save();
                    }
                }
            }
        }catch(\Exception $e){
            return response()->json(['msg' =>$e->getMessage()]);
        }
    }


    public function destroy($id){
        $detailrealisasi = Realisasi::where('id_detail_realisasi',$id)->get();
        foreach ($detailrealisasi as $key => $value) {
             $detailbahan = DetailBahanRealisasi::where('id_detail_realisasi',$value->id_detail_realisasi)->delete();
         }
        $detailrealisasi = Realisasi::where('id_detail_realisasi',$id)->delete();
    }

    public function get_data(Request $request){
        $detailrealisasi = DB::select("SELECT a.id_detail_rab,IFNULL(b.persentase,0) AS persentase,b.id_detail_realisasi,a.kegiatan, IFNULL(DATEDIFF(b.tanggal_selesai,b.tanggal_mulai),'') AS durasi,IFNULL(b.tanggal_mulai,'') as tanggal_mulai,IFNULL(b.tanggal_selesai,'') as tanggal_selesai,IFNULL((SELECT SUM(VOLUME*HARGA) FROM detail_bahan_realisasi WHERE id_detail_realisasi = b.id_detail_realisasi),0) as harga_satuan, IFNULL(b.volume_realisasi,'') as volume_realisasi,IFNULL(b.satuan_realisasi,'') AS satuan_realisasi,IFNULL(volume_realisasi,0)*IFNULL((SELECT SUM(VOLUME*HARGA) FROM detail_bahan_realisasi WHERE id_detail_realisasi = b.id_detail_realisasi),0) as biaya FROM detail_rab a left join detail_realisasi b on a.id_detail_rab=b.id_detail_rab where a.id_kategori = $request->id_kategori and id_rab = $request->id_rab");
        return Datatables::of($detailrealisasi)->addColumn('action', function ($detailrealisasi) {
            return '<a href="" class="button" data-id="'.$detailrealisasi->id_detail_realisasi.'"><i class="glyphicon glyphicon-repeat"></i> Cancel</a>';
        })
        ->make(true);
    }

    public function get_datas(Request $request){
        $detailrealisasi = DB::select("SELECT D.ID_KATEGORI,F.NAMA_KATEGORI FROM DETAIL_RAB D JOIN Kategori F ON D.ID_KATEGORI=F.ID_KATEGORI left JOIN detail_bahan E ON E.id_detail_realisasi=D.id_detail_realisasi where id_realisasi = $request->id_realisasi GROUP BY D.id_kategori,F.nama_kategori");
        return Datatables::of($detailrealisasi)->make(true);
    }

    public function getDetail(Request $request){
        $detailrealisasi = DB::select("SELECT * FROM detail_realisasi A JOIN Kategori B ON A.ID_KATEGORI=B.ID_KATEGORI where a.id_detail_realisasi = $request->id_detail_realisasi");
        return response()->json($detailrealisasi[0]);
    }

    public function destroyDetailBahan($id){
        $detail = DetailBahanRealisasi::find($id);
        $detailbahan = DetailBahanRealisasi::find($id)->delete();
        return response()->json($detail);
    }

    public function getDetailBahan(Request $request){
        $detailbahan = DB::select("SELECT * FROM detail_bahan_realisasi A JOIN BAHAN B ON A.id_bahan=B.id_bahan WHERE id_detail_realisasi = $request->id_detail_realisasi");
        return response()->json($detailbahan);
    }

    public function peringatanBiaya(Request $request){

        $peringatan = DB::select("SELECT g.nama_rab, h.nama_proyek,j.nama_kategori,a.id_detail_rab as id,(select sum(c.volume*c.harga)*d.volume_rab from detail_bahan c join detail_rab d on c.id_detail_rab=d.id_detail_rab where c.id_detail_rab = a.id_detail_rab) as biaya_rencana ,(select IFNULL(sum(c.volume*c.harga)*d.volume_realisasi,0) from detail_bahan_realisasi c join detail_realisasi d on c.id_detail_realisasi=d.id_detail_realisasi where d.id_detail_rab = a.id_detail_rab) as biaya_realisasi,(select sum(c.volume*c.harga)*d.volume_rab from detail_bahan c join detail_rab d on c.id_detail_rab=d.id_detail_rab where c.id_detail_rab = a.id_detail_rab) - (select IFNULL(sum(c.volume*c.harga)*d.volume_realisasi,0) from detail_bahan_realisasi c join detail_realisasi d on c.id_detail_realisasi=d.id_detail_realisasi where d.id_detail_rab = a.id_detail_rab) as selisih  FROM detail_bahan a left join detail_rab b on a.id_detail_rab=b.id_detail_rab JOIN rab g on g.id_rab=b.id_rab JOIN proyek h on h.id_proyek=g.id_proyek left join kategori j on j.id_kategori=b.id_kategori left join detail_realisasi k on k.id_detail_rab=b.id_detail_rab where k.id_detail_realisasi = $request->id_detail_realisasi and (select sum(c.volume*c.harga)*d.volume_rab from detail_bahan c join detail_rab d on c.id_detail_rab=d.id_detail_rab where c.id_detail_rab = a.id_detail_rab)*0.9 < (select IFNULL(sum(c.volume*c.harga)*d.volume_realisasi,0) from detail_bahan_realisasi c join detail_realisasi d on c.id_detail_realisasi=d.id_detail_realisasi where d.id_detail_rab = a.id_detail_rab) GROUP BY a.id_detail_rab");
        if(count($peringatan) > 0){
            $peringatan[0]->error = "noerror";
            return response()->json($peringatan[0]);
        }else{
            return response()->json(["error" => "nodata"]);
        }
        
    }

    public function hitungPerencanan(Request $request){
        $perencanaan = DB::select("SELECT IFNULL(sum(c.volume*c.harga)*d.volume_rab,0) as biaya from detail_bahan c join detail_rab d on c.id_detail_rab=d.id_detail_rab left join detail_realisasi f on d.id_detail_rab=f.id_detail_rab where c.id_detail_rab = $request->id_detail_rab or f.id_detail_realisasi = $request->id_detail_realisasi");
        if(count($perencanaan) > 0){
            $perencanaan[0]->error = "noerror";
            return response()->json($perencanaan[0]);
        }else{
            return response()->json(["error" => "nodata"]);
        }
    }
}

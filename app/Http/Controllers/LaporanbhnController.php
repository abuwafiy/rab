<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Rab;
use DB;
use PDF;
use App;

class LaporanbhnController extends Controller
{
    public function index(Request $request){
        $this->page_attributes->title = 'Laporan Pengajuan Tambah Bahan';
      
        $id_rab = 0;
        if(isset($request->id_rab)){
            $id_rab=$request->id_rab;
        }
        $rab = rab::get();
        $pengajuan_tambah_bahan = DB::select("SELECT a.nama_rab from pengajuan_tambah_bahan b join rab a on b.id_rab=a.id_rab where a.id_rab = $id_rab");
        $this->view = view('pages.laporanbhn.index',compact('pengajuan_tambah_bahan','rab'));
        return $this->generateView(); 
    }
    public function generatePDF(Request $request){
        $rab =rab::get(); 
        $id_rab = 0;
        $pengajuan_tambah_bahan = DB::selecT("SELECT a.nama_rab from pengajuan_tambah_bahan b join rab a on b.id_rab=a.id_rab where a.id_rab = $id_rab");
        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadview('pages.laporanbhn.print',['pengajuan_tambah_bahan'=>$pengajuan_tambah_bahan,'pengajuan_tambah_bahan'=>$pengajuan_tambah_bahan,'summary'=>$summary])->setPaper('a4', 'landscape');;
        return $pdf->stream('Laporan Pengajuan - '.$request->id_rab.'.pdf');
    }
}

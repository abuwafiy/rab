<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use DB;
use PDF;
use App;

class PeriodeController extends Controller
{
    public function index(Request $request){
        $this->page_attributes->title = 'Laporan Periode Proyek';
        $x = 0;
        $id_rab = 0;
        $tanggal_mulai=$request->tanggal_mulai;
        $tanggal_selesai=$request->tanggal_selesai;
        $rab = Rab::get();
        $periode = [];
        if(isset($request->id_rab)){
            $id_rab=$request->id_rab;
        }
        $kategori = DB::select("SELECT a.id_kategori,b.nama_kategori FROM detail_rab a join kategori b on a.id_kategori=b.id_kategori join rab c on c.id_rab=a.id_rab where c.id_rab=$id_rab group by a.id_kategori");
        $detail = DB::selecT("SELECT e.id_kategori,e.nama_kategori,a.kegiatan,ifnull(c.persentase,0) as persentase, (SELECT IFNULL(SUM(g.volume*g.harga),0) FROM detail_bahan g where g.id_detail_rab=a.id_detail_rab)*IFNULL(a.volume_rab,0) as rab, (SELECT IFNULL(SUM(h.volume*h.harga),0) FROM detail_bahan_realisasi h where h.id_detail_realisasi = c.id_detail_realisasi)*IFNULL(c.volume_realisasi,0) as realisasi FROM detail_rab a left join kategori e on e.id_kategori=a.id_kategori left JOIN detail_realisasi c on c.id_detail_rab=a.id_detail_rab where ( a.id_rab=$id_rab and c.tanggal_mulai and c.tanggal_selesai BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' ) GROUP BY  c.id_detail_realisasi ");
        foreach ($kategori as $i => $value) {
            $periode[$x]['nama_kategori'] = $value->nama_kategori;
            $z = 0;
            foreach ($detail as $y => $item) {
                if($value->id_kategori == $item->id_kategori){
                    $periode[$x]['detail'][$z]['kegiatan'] = $item->kegiatan;
                    $periode[$x]['detail'][$z]['persentase'] = $item->persentase;
                    $periode[$x]['detail'][$z]['rab']  = number_format($item->rab, 2, '.', ',');
                    $periode[$x]['detail'][$z]['realisasi']  = number_format($item->realisasi, 2, '.', ',');
                    $periode[$x]['detail'][$z]['selisih']  =  number_format($item->rab- $item->realisasi, 2, '.', ',');
                    if($item->rab > 0)
                        $periode[$x]['detail'][$z]['indeks']  = number_format((double)((double)$item->rab - (double) $item->realisasi) / (double) $item->rab * 100, 2, '.', '');
                    else
                        $periode[$x]['detail'][$z]['indeks'] = 0;
                    $z++;
                }
            }
            $x++;
        } 
        $this->view = view('pages.periode.index',compact('periode','rab','id_rab','tanggal_mulai','tanggal_selesai'));
        return $this->generateView(); 
    }

    public function generatePDF(Request $request){
     
        $tanggal_mulai=$request->tanggal_mulai;
        $tanggal_selesai=$request->tanggal_selesai;
        $x = 0;
        $count = 0;
        $periode = [];
        if(isset($request->id_rab)){
            $id_rab=$request->id_rab;
        }
        $summary = [];
        $summary['rab'] = 0;
        $summary['realisasi'] = 0;
        $summary['selisih'] = 0;
        $summary['indeks'] = 0;
        $rab = Rab::where('rab.id_rab' ,$id_rab)->leftJoin('proyek', 'proyek.id_proyek','=','rab.id_proyek')->first();
        $kategori = DB::select("SELECT a.id_kategori,b.nama_kategori FROM detail_rab a join kategori b on a.id_kategori=b.id_kategori join rab c on c.id_rab=a.id_rab where c.id_rab=$id_rab group by a.id_kategori");
        $detail = DB::selecT("SELECT e.id_kategori,e.nama_kategori,a.kegiatan,ifnull(c.persentase,0) as persentase,
            (SELECT IFNULL(SUM(g.volume*g.harga),0) FROM detail_bahan g where g.id_detail_rab=a.id_detail_rab)*IFNULL(a.volume_rab,0) as rab,
            (SELECT IFNULL(SUM(h.volume*h.harga),0) FROM detail_bahan_realisasi h where h.id_detail_realisasi = c.id_detail_realisasi)*IFNULL(c.volume_realisasi,0) as realisasi
            FROM detail_rab a  left join kategori e on e.id_kategori=a.id_kategori  
            left JOIN detail_realisasi c on c.id_detail_rab=a.id_detail_rab
            where a.id_rab=$id_rab GROUP BY  c.id_detail_realisasi ");
        foreach ($kategori as $i => $value) {
            $periode[$x]['nama_kategori'] = $value->nama_kategori;
            $z = 0;
            foreach ($detail as $y => $item) {
                if($value->id_kategori == $item->id_kategori){
                    $periode[$x]['detail'][$z]['kegiatan'] = $item->kegiatan;
                    $periode[$x]['detail'][$z]['persentase'] = $item->persentase;
                    $periode[$x]['detail'][$z]['rab']  = number_format($item->rab, 2, '.', ',');
                    $periode[$x]['detail'][$z]['realisasi']  = number_format($item->realisasi, 2, '.', ',');
                    $periode[$x]['detail'][$z]['selisih']  =  number_format($item->rab- $item->realisasi, 2, '.', ',');
                    if($item->rab > 0)
                        $periode[$x]['detail'][$z]['indeks']  = number_format((double)((double)$item->rab - (double) $item->realisasi) / (double) $item->rab * 100, 2, '.', '');
                    else
                        $periode[$x]['detail'][$z]['indeks'] = 0;

                    $summary['rab'] = $summary['rab'] + $item->rab;
                    $summary['realisasi'] = $summary['realisasi'] + $item->realisasi;
                    $summary['selisih'] = $summary['selisih'] + ($item->rab- $item->realisasi);
                    if($item->rab > 0)
                        $summary['indeks'] = ($summary['indeks']) + (double)((double)$item->rab - (double) $item->realisasi) / (double) $item->rab * 100;
                    else
                        $summary['indeks'] = ($summary['indeks']) + 0;
                        $z++;

                    $count++;
                }
            }
            $x++;
        } 
        $summary['indeks'] = (double)($summary['indeks'])/$count;
        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadview('pages.periode.print',['periode'=>$periode,'rab'=>$rab,'summary'=>$summary])->setPaper('a4', 'landscape');;
        return $pdf->stream('Laporan RAB - '.$request->id_rab.'.pdf');
    }
}

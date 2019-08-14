<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use DB;
use PDF;
use App;

class ReportController extends Controller
{
    public function index(Request $request){
        $this->page_attributes->title = 'Laporan Realisasi Proyek';
        $x = 0;
        $id_rab = 0;
        $rab = Rab::get();
        $report = [];
        if(isset($request->id_rab)){
            $id_rab=$request->id_rab;
        }
        $kategori = DB::select("SELECT a.id_kategori,b.nama_kategori FROM detail_rab a join kategori b on a.id_kategori=b.id_kategori join rab c on c.id_rab=a.id_rab where c.id_rab=$id_rab group by a.id_kategori");
        $detail = DB::selecT("SELECT e.id_kategori,e.nama_kategori,a.kegiatan,DATEDIFF(a.tanggal_selesai,a.tanggal_mulai) as durasi,DATEDIFF(c.tanggal_selesai,c.tanggal_mulai) AS durasireal, DATEDIFF(a.tanggal_selesai,a.tanggal_mulai) -DATEDIFF(c.tanggal_selesai,c.tanggal_mulai) as selisihhari ,ifnull(c.persentase,0) as persentase,
            (SELECT IFNULL(SUM(g.volume*g.harga),0) FROM detail_bahan g where g.id_detail_rab=a.id_detail_rab)*IFNULL(a.volume_rab,0) as rab,
            (SELECT IFNULL(SUM(h.volume*h.harga),0) FROM detail_bahan_realisasi h where h.id_detail_realisasi = c.id_detail_realisasi)*IFNULL(c.volume_realisasi,0) as realisasi
            FROM detail_rab a  left join kategori e on e.id_kategori=a.id_kategori  
            left JOIN detail_realisasi c on c.id_detail_rab=a.id_detail_rab
            where a.id_rab=$id_rab");
        foreach ($kategori as $i => $value) {
            $report[$x]['nama_kategori'] = $value->nama_kategori;
            $z = 0;
            foreach ($detail as $y => $item) {
                if($value->id_kategori == $item->id_kategori){
                    $report[$x]['detail'][$z]['kegiatan'] = $item->kegiatan;
                    $report[$x]['detail'][$z]['durasi'] = $item->durasi;
                    $report[$x]['detail'][$z]['durasireal'] = $item->durasireal;
                    $report[$x]['detail'][$z]['selisihhari'] = $item->selisihhari;
                    $report[$x]['detail'][$z]['persentase'] = $item->persentase;
                    $report[$x]['detail'][$z]['rab']  = number_format($item->rab, 2, '.', ',');
                    $report[$x]['detail'][$z]['realisasi']  = number_format($item->realisasi, 2, '.', ',');
                    $report[$x]['detail'][$z]['selisih']  =  number_format($item->rab- $item->realisasi, 2, '.', ',');
                    if($item->rab > 0)
                        $report[$x]['detail'][$z]['indeks']  = number_format((double)((double)$item->rab - (double) $item->realisasi) / (double) $item->rab * 100, 2, '.', '');
                    else
                        $report[$x]['detail'][$z]['indeks'] = 0;
                    $z++;
                }
            }
            $x++;
        } 
        $this->view = view('pages.report.index',compact('report','rab','id_rab'));
        return $this->generateView(); 
    }

    public function generatePDF(Request $request){
        $x = 0;
        $count = 0;
        $report = [];
        if(isset($request->id_rab)){
            $id_rab=$request->id_rab;
        }
        $summary = [];
        $summary['rab'] = 0;
        $summary['persentase'] = 0;
        $summary['durasi']=0;
        $summary['durasireal']=0;
        $summary['selisihhari']=0;
        $summary['realisasi'] = 0;
        $summary['selisih'] = 0;
        $summary['indeks'] = 0;
        $rab = Rab::where('rab.id_rab',$id_rab)->leftJoin('proyek', 'proyek.id_proyek','=','rab.id_proyek')->first();
        $kategori = DB::select("SELECT a.id_kategori,b.nama_kategori FROM detail_rab a join kategori b on a.id_kategori=b.id_kategori join rab c on c.id_rab=a.id_rab where c.id_rab=$id_rab group by a.id_kategori");
        $detail = DB::selecT("SELECT e.id_kategori,e.nama_kategori,a.kegiatan,DATEDIFF(a.tanggal_selesai,a.tanggal_mulai) as durasi,DATEDIFF(c.tanggal_selesai,c.tanggal_mulai) AS durasireal, DATEDIFF(a.tanggal_selesai,a.tanggal_mulai) -DATEDIFF(c.tanggal_selesai,c.tanggal_mulai) as selisihhari ,ifnull(c.persentase,0) as persentase,
            (SELECT IFNULL(SUM(g.volume*g.harga),0) FROM detail_bahan g where g.id_detail_rab=a.id_detail_rab)*IFNULL(a.volume_rab,0) as rab,
            (SELECT IFNULL(SUM(h.volume*h.harga),0) FROM detail_bahan_realisasi h where h.id_detail_realisasi = c.id_detail_realisasi)*IFNULL(c.volume_realisasi,0) as realisasi
            FROM detail_rab a  left join kategori e on e.id_kategori=a.id_kategori  
            left JOIN detail_realisasi c on c.id_detail_rab=a.id_detail_rab
            where a.id_rab=$id_rab");
        foreach ($kategori as $i => $value) {
            $report[$x]['nama_kategori'] = $value->nama_kategori;
            $z = 0;
            foreach ($detail as $y => $item) {
                if($value->id_kategori == $item->id_kategori){
                    $report[$x]['detail'][$z]['kegiatan'] = $item->kegiatan;
                    $report[$x]['detail'][$z]['durasi'] = $item->durasi;
                    $report[$x]['detail'][$z]['durasireal'] = $item->durasireal;
                    $report[$x]['detail'][$z]['selisihhari'] = $item->selisihhari;
                    $report[$x]['detail'][$z]['persentase'] = $item->persentase;
                    $report[$x]['detail'][$z]['rab']  = number_format($item->rab, 2, '.', ',');
                    $report[$x]['detail'][$z]['realisasi']  = number_format($item->realisasi, 2, '.', ',');
                    $report[$x]['detail'][$z]['selisih']  =  number_format($item->rab- $item->realisasi, 2, '.', ',');
                    if($item->rab > 0)
                        $report[$x]['detail'][$z]['indeks']  = number_format((double)((double)$item->rab - (double) $item->realisasi) / (double) $item->rab * 100, 2, '.', '');
                    else
                        $report[$x]['detail'][$z]['indeks'] = 0;

                    $summary['rab'] = $summary['rab'] + $item->rab;
                    $summary['durasi'] = $summary['durasi'] + $item->durasi;
                    $summary['durasireal'] = $summary['durasireal'] + $item->durasireal;
                    $summary['persentase'] = $summary['persentase'] + $item->persentase;
                    $summary['selisihhari'] = $summary['selisihhari'] + $item->selisihhari;
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
        $summary['persentase'] = (double)($summary['persentase'])/$count;
        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadview('pages.report.print',['report'=>$report,'rab'=>$rab,'summary'=>$summary])->setPaper('a4', 'landscape');;
        return $pdf->stream('Laporan RAB - '.$request->id_rab.'.pdf');
    }
}

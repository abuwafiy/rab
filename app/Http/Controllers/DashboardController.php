<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Rab;
use App\Models\Proyek;
use App\Models\Pengajuan;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
	public function index(Request $request){
		$this->page_attributes->title = 'DashBoard'; 
		$countt = Proyek::count(); 
		$pengajuan = Pengajuan::where('status_approval','=','0')->count();
		$aktif = Proyek::where('status','=','aktif')->count();
		$nonaktif = Proyek::where('status','=','non aktif')->count();
		$rab = Rab::get();
		$date = self::getChart($request);
		$this->view = view('pages.dashboard.index', compact('countt','date','rab','pengajuan','aktif','nonaktif'));
		return $this->generateView(); 

	}

	public function getChart(Request $request){
		if(!isset($request->id_rab)){
			$request->id_rab = -1;
		}

		$date = DB::select("SELECT MIN(startdate) as startdate, max(enddate) as enddate from (SELECT tanggal_mulai as startdate,tanggal_selesai as enddate  FROM detail_rab union  SELECT tanggal_mulai as startdate,tanggal_selesai as enddate  FROM detail_realisasi ) as tabel_baru");
		$startdate = Carbon::parse($date[0]->startdate);
		$enddate = Carbon::parse($date[0]->enddate);
		$diff = $startdate->diffInDays($enddate);
		$myDate = [];
		$myDate[0]['date'] = $startdate->format('Y-m-d');
		for($i=1; $i <= $diff;$i++){
			$newDate = $startdate->addDays(1);
			$myDate[$i]['date'] =  $newDate->format('Y-m-d');
		}

		$rab = DB::select("SELECT sum(a.volume*a.harga)*b.volume_rab as total, b.tanggal_mulai FROM detail_bahan a left join detail_rab b on a.id_detail_rab=b.id_detail_rab where b.id_rab = $request->id_rab GROUP by b.id_detail_rab,b.tanggal_mulai order by tanggal_mulai");
		$total_rab = 0;
		foreach ($myDate as $i => $currentDate) {
			foreach ($rab as $y => $value) {
				if($currentDate['date'] == $value->tanggal_mulai){
					$total_rab = $total_rab + $value->total;
				}
			}
			$myDate[$i]['rab'] = $total_rab;
		}

		$realisasi = DB::select("SELECT sum(a.volume*a.harga)*b.volume_realisasi as total, b.tanggal_mulai FROM detail_bahan_realisasi a left join detail_realisasi b on a.id_detail_realisasi=b.id_detail_realisasi join detail_rab c on c.id_detail_rab=b.id_detail_rab where c.id_rab = $request->id_rab GROUP by b.id_detail_realisasi,b.tanggal_mulai order by tanggal_mulai");
		$total_realisasi = 0;
		foreach ($myDate as $i => $currentDate) {
			foreach ($realisasi as $y => $value) {
				if($currentDate['date'] == $value->tanggal_mulai){
					$total_realisasi = $total_realisasi + $value->total;
				}
			}
			$myDate[$i]['realisasi'] = $total_realisasi;
		}

		return $myDate;
	}



}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use DB;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            $menu = [];
            $jabatan = session('jabatan') ?? '0';
            $header = DB::select("SELECT distinct a.nama_header,a.id_header FROM HEADER a join menu b on a.id_header = b.id_header join MENU_PARENT c on c.id_menu=b.id_menu join detail_group d on d.id_parent = c.id_parent where id_jabatan = $jabatan");
            foreach ($header as $key => $value) {
                $menu[$key]['nama_header'] = $value->nama_header;
                $mn = DB::select("SELECT distinct b.nama_menu,b.url,b.icon,b.id_menu FROM MENU b join MENU_PARENT c on c.id_menu=b.id_menu join detail_group d on d.id_parent = c.id_parent where id_jabatan = $jabatan and ID_HEADER = $value->id_header");
                foreach ($mn as $i => $val) {
                    $menu[$key]['menu'][$i]['nama_menu'] = $val->nama_menu;
                    $menu[$key]['menu'][$i]['url'] = $val->url;
                    $menu[$key]['menu'][$i]['icon'] = $val->icon;              
                    $menu[$key]['menu'][$i]['isactive'] = "";
                    $menu[$key]['menu'][$i]['show'] = "";
                    $mnp = DB::select("SELECT distinct c.* FROM MENU_PARENT c join detail_group d on d.id_parent = c.id_parent  WHERE ID_MENU = $val->id_menu and d.id_jabatan = $jabatan");
                    foreach ($mnp as $y => $item) {
                        if(request()->segment(1) == $item->url){
                            $menu[$key]['menu'][$i]['isactive'] = "active";
                            $menu[$key]['menu'][$i]['show'] = "show";
                        }

                        $menu[$key]['menu'][$i]['submenu'][$y]['namasub']= $item->nama_parent;
                        $menu[$key]['menu'][$i]['submenu'][$y]['urlsub']= $item->url;
                    }
                }


            }
            $data = json_encode($menu);
            View::share('menudata', json_decode($data));
        });
    }
}

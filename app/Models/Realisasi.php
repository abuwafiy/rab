<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = 'detail_realisasi';

    protected $primaryKey = 'id_detail_realisasi';

    public $incrementing = true;

    public $timestamps = false;

     protected $fillable = ['id_detail_rab','id_kategori','kegiatan','volume_realisasi','satuan_realisasi','tanggal_mulai','tanggal_selesai','persentase'];
}

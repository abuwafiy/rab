<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRab extends Model
{
    protected $table = 'detail_rab';

    protected $primaryKey = 'id_detail_rab';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['id_rab','id_kategori','kegiatan','tanggal_mulai','tanggal_selesai','volume_rab','satuan_rab'];
}

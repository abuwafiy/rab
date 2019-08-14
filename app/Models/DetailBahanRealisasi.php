<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBahanRealisasi extends Model
{
    protected $table = 'detail_bahan_realisasi';

    protected $primaryKey = 'id_detail_bahan_realisasi';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['id_detail_bahan_realisasi','id_detail_realisasi','id_bahan','volume','satuan','harga'];
}

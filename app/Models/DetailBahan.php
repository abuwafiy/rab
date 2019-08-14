<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBahan extends Model
{
    protected $table = 'detail_bahan';

    protected $primaryKey = 'id_detail_bahan';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['id_detail_bahan','id_detail_rab','id_bahan','volume','satuan','harga'];
}

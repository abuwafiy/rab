<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';

    protected $primaryKey = 'id_bahan';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['nama_bahan','satuan','harga','kategori_bahan'];
}

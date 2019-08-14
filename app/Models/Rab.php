<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $table = 'rab';

    protected $primaryKey = 'id_rab';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['id_proyek','nama_rab','lokasi','luas_tanah','luas_bangunan'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';

    protected $primaryKey = 'id_proyek';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['nama_proyek','lokasi_proyek','status'];
}

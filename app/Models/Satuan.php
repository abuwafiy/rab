<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';

    protected $primaryKey = 'id_satuan';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['nama_satuan'];
}

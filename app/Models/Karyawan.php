<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
	protected $table = 'karyawan';

    protected $primaryKey = 'nik';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['nik','id_jabatan','nama_karyawan','alamat_karyawan','no_hp','password'];
}
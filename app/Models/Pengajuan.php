<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan_tambah_bahan';

    protected $primaryKey = 'id_pengajuan';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['id_proyek','id_rab','id_kategori','keterangan_pengajuan','tanggal_pengajuan','status_approval'];
}

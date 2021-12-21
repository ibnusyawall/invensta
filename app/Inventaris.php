<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama', 'kondisi', 'keterangan',
        'jumlah', 'tanggal_register', 'kode_inventaris',
        'jenis_id', 'ruang_id', 'petugas_id',
    ];

    public function petugas()
    {
        return $this->belongsTo('App\Petugas');
    }

    public function ruang()
    {
        return $this->belongsTo('App\Ruang');
    }

    public function jenis()
    {
        return $this->belongsTo('App\Jenis');
    }

    public function detail_pinjam()
    {
        return $this->hasMany('App\Detail_pinjam');
    }
}

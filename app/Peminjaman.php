<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjamen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tanggal_pinjam', 'tanggal_kembali', 'status_peminjaman', 'pegawai_id',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai');
    }

    public function detail_pinjam()
    {
        return $this->hasMany('App\Detail_pinjam');
    }
}

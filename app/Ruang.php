<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama_ruang', 'kode_ruang', 'keterangan',
    ];

    public function inventaris()
    {
        return $this->hasMany('App\Inventaris');
    }
}

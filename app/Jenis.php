<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama_jenis', 'kode_jenis', 'keterangan',
    ];

    public function inventaris()
    {
        return $this->hasMany('App\Inventaris');
    }
}

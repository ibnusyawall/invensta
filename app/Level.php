<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama_level',
    ];

    public function petugas()
    {
        return $this->hasMany('App\Petugas');
    }
}

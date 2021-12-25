<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class pegawai extends Authenticatable
{
   use HasApiTokens, Notifiable;
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama_pegawai', 'username', 'nip', 'alamat', 'petugas_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function petugas()
    {
        return $this->belongsTo('App\Petugas');
    }

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }
}

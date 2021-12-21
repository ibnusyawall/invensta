<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_pinjam extends Model
{
    protected $table = 'detail_pinjams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'jumlah', 'inventaris_id', 'peminjaman_id',
    ];

    public function inventaris()
    {
        return $this->belongsTo('App\Inventaris');
    }

    public function peminjaman()
    {
        return $this->belongsTo('App\Peminajaman');
    }
}

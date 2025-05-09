<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'id',
        'nama_barang',
        'harga_barang',
        'kode_barang'
    ];

    public function detail(){
        return $this->hasMany(Detail::class, 'barang_id', 'id');
    }
}

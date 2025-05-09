<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $table = 'details';

    protected $fillable = ['faktur_id', 'barang_id', 'diskon', 'nama_barang', 'harga', 'subtotal', 'qty', 'hasil_qty'];

    public function fakturs(){
        return $this->belongsTo(Faktur::class);
    }

    public function barangs(){
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}

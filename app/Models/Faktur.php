<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faktur extends Model
{
    use SoftDeletes;

    protected $table = 'fakturs';
    protected $fillable = ['kode_faktur', 'kode_customer', 'tanggal_faktur', 'customer_id', 'keterangan_faktur', 'total', 'nominal_charge', 'charge', 'total_final'];

    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function details(){
        return $this->hasMany(Detail::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Furnitur extends Model
{
    //
    protected $fillable = ['nama_furnitur','konsumen_id','jumlah_furnitur','harga_furnitur'];
     public function konsumen()
 {
 	return $this->belongsTo('App\Konsumen');
 }
}

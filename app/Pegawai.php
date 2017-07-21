<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Pegawai extends Model
{
    //
    protected $fillable = ['nama_pegawai'];
    public static function boot()
 {
 	parent::boot();

 	self::deleting(function($pegawai){
 		if($pegawai->barangs->count() > 0){
 			$html='pegawai tidah bisa dihapus karena masih memiliki barang :';
 			$html .='<ul>';
 			foreach ($pegawai->barangs as $barang){
 				$html .="<li>$barang->title</li>";
 			}

 			$html .='</ul>';
 			Session::flash("flash_notification",[
 				"level"=>"danger",
 				"message"=>$html 
 				]);
 			return false;
 		}
 	});
 }
     public function barangs()
 {
 	return $this->hasMany('App\Barang');
 }
}

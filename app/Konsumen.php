<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Konsumen extends Model
{
    //
    protected $fillable = ['nama_konsumen'];
    public static function boot()
 {
 	parent::boot();

 	self::deleting(function($konsumen){
 		if($konsumen->furniturs->count() > 0){
 			$html='konsumen tidah bisa dihapus karena masih memiliki furnitur :';
 			$html .='<ul>';
 			foreach ($konsumen->furniturs as $furnitur){
 				$html .="<li>$furnitur->nama_furnitur</li>";
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
     public function furniturs()
 {
 	return $this->hasMany('App\Furnitur');
 }
}

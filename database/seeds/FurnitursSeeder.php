<?php

use Illuminate\Database\Seeder;
use App\Konsumen;
use App\Furnitur;

class FurnitursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample konsumen
        $konsumen1= konsumen::create(['nama_konsumen'=>'Mohammad Ali']);
        $konsumen2= konsumen::create(['nama_konsumen'=>'Asep']);
        $konsumen3= konsumen::create(['nama_konsumen'=>'Aam Amiruddin ']);
        
        //Sample buku
        $furnitur1= furnitur::create(['nama_furnitur'=>'AC','jumlah_furnitur'=>3,'harga_furnitur'=>20000,'konsumen_id'=>$konsumen1->id]);
        $furnitur2= furnitur::create(['nama_furnitur'=>'TV','jumlah_furnitur'=>3,'harga_furnitur'=>20000,'konsumen_id'=>$konsumen2->id]);
        $furnitur3= furnitur::create(['nama_furnitur'=>'Lemari','jumlah_furnitur'=>3,'harga_furnitur'=>20000,'konsumen_id'=>$konsumen3->id]);
        
           
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnitursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniturs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_furnitur');
            $table->integer('konsumen_id')->unsigned();
            $table->integer('jumlah_furnitur')->unsigned();
            $table->integer('harga_furnitur');
            $table->string('cover')->nullable();
            $table->timestamps();

            $table->foreign('konsumen_id')->references('id')->on('konsumens')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniturs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*se ejecuta en el  momento que se crea la tabla*/
    public function up()
    {
        /*movie: id(pk), title (unique), director, year, genre(null)*/
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('title',60)->unique(); 
            $table->string('director',110);
            $table->integer('year');
            $table->string('genre',50)->nullable();
            $table->timestamps(); //marcas de tiempo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*se ejecuta en el  momento que se borra la tabla*/
    public function down()
    {
        Schema::dropIfExists('movie');
    }
};

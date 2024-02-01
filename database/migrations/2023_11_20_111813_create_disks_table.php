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
public function up()
    {
        /*movie: id(pk), title (unique), director, year, genre(null)*/
        Schema::create('disk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idartist');
            $table->string('title',60);
            $table->integer('year')->nullable();
            $table->binary('cover');
            $table->timestamps(); //marcas de tiempo
            //definir la clave foranea
            $table->foreign('idartist')->references('id')->on('artist')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['idartist','title']);
        });
        $sql='alter table disk change cover cover longblob';
        DB::statement($sql);
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disk');
    }
};

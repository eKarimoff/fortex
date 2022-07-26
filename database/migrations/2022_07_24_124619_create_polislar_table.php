<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polislar', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unsigned();
            $table->string('davlat_id');
            $table->string('summa');
            $table->string('mashina_raqami');
            $table->string('polis_raqami');
            $table->string('mijoz_ismi');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('davlat_id')->references('id')->on('davlatlar')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polislar');
    }
}

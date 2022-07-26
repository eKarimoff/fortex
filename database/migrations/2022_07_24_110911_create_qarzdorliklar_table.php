<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQarzdorliklarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qarzdorliklar', function (Blueprint $table) {
            $table->id();
            $table->string('qarzdor_ismi');
            $table->string('davlat_id')->unsigned();
            $table->string('summa');
            $table->string('mashina_raqami');
            $table->foreign('davlat_id')->references('id')->on('davlatlar')->onDelete('casCade');
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
        Schema::dropIfExists('qarzdorliklar');
    }
}

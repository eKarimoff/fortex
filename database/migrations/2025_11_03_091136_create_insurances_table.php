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
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('insurance_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('insurance_status_id')->constrained()->cascadeOnDelete();
            $table->string('insurance_number')->unique();
            $table->string('car_number');
            $table->string('start_date')->date('coverage start');
            $table->string('end_date')->date('coverage end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};

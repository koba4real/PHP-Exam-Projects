<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaziones', function (Blueprint $table) {
            $table->id();
            $table->double('importo');
            $table->string('descrizione');
            $table->date('data');
            $table->boolean('tipo’')->default(false);//(spesa o entrata).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaziones');
    }
};

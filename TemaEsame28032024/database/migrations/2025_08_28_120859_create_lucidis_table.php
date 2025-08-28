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
        Schema::create('lucidis', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('file_path');
            $table->text('commento')->nullable();
             $table->boolean('is_public')->default(false); // Un interruttore "Visibile a tutti" (spento di default).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucidis');
    }
};

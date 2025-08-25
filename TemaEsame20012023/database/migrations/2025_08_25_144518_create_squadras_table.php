<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('squadras', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->integer('punti')->default(0);
            $table->integer('partite_giocate')->default(0);
            $table->integer('vittorie')->default(0);
            $table->integer('pareggi')->default(0);
            $table->integer('sconfitte')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('squadras');
    }
};

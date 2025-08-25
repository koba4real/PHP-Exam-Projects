<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class squadra extends Model
{
    //
   protected $fillable = [
        'nome',
        // In futuro, se dovessi creare una squadra specificando anche
        // i punti, dovresti aggiungere 'punti' a questo array, ecc.
    ];
}

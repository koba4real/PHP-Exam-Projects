<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class squadra extends Model
{
    //
   protected $fillable = [
        'nome',
        'punti',
        'partite_giocate',
        'vittorie',
        'pareggi',
        'sconfitte',
    ];
}

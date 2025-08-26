<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $fillable = [
        'nome',
        'cognome',
        'matricola',
        'voto',
        'lode',
        'data_esame',
        'commento',
    ];

    
}

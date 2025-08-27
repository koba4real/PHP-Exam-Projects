<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $fillable = [
        'data_appello',
        'matricola',
        'cognome',
        'nome',
        'voto',
    ];
    protected $casts = [
        'matricola' => 'integer',
        'voto' => 'integer'
    ];
    
    /**
     * Get the formatted vote display
     */
    public function getVotoFormattedAttribute()
    {
        if ($this->voto === -1) {
            return 'Insufficiente';
        } elseif ($this->voto === 33) {
            return '30 e Lode';
        } else {
            return (string) $this->voto;
        }
    }
    
    /**
     * Get the vote type for the select dropdown
     */
    public function getVotoTypeAttribute()
    {
        if ($this->voto === -1) {
            return 'insufficiente';
        } elseif ($this->voto === 33) {
            return 'lode';
        } else {
            return 'superato';
        }
    }
}

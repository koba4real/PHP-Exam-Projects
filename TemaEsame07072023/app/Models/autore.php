<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class autore extends Model
{
    //
    protected $fillable = ['nome', 'cognome','email','istituto'];

    public function articoli()
    {
        return $this->belongsToMany(articolo::class);
    }
}

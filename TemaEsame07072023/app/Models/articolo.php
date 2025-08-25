<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class articolo extends Model
{
    protected $fillable = ['titolo'];

    public function autori()
    {
        return $this->belongsToMany(autore::class);
    }
}

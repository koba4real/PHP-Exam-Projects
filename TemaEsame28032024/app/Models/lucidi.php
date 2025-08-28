<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lucidi extends Model
{
    /** @use HasFactory<\Database\Factories\LucidiFactory> */
    use HasFactory;
    protected $fillable = ['titolo', 'file_path', 'commento', 'is_public'];
}

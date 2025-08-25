<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Articolo;

class ArticoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Articolo::insert([
            [
                'titolo' => 'the 48 laws of power',
            ],
            [
                'titolo' => 'the art of war',
            ],
            [
                'titolo' => 'the prince',
            ],
        ]);
    }
}

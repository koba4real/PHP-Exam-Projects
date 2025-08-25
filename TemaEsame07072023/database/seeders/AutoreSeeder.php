<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Autore;

class AutoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Autore::insert([
            [
                'nome' => 'Koba',
                'cognome' => 'Yonko',
                'email' => 'o.kharef@example.com',
                'istituto' => 'unibs',
            ],
            [
                'nome' => 'Malek',
                'cognome' => 'djedje',
                'email' => 'm.djelouah@example.com',
                'istituto' => 'Sorbonne',
            ],
        ]);
    }
}

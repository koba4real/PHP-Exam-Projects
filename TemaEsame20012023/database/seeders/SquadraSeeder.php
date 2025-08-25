<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Squadra;

class SquadraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Squadra::truncate();

    $filePath = database_path('seeders/data/squadre.txt');

    // DEBUG: Il file esiste? Dovrebbe stampare 'true'
    // dd(File::exists($filePath));

    $squadre = File::lines($filePath)->filter(); // .filter() rimuove righe vuote

    // DEBUG: Cosa ha letto dal file? Dovrebbe mostrare un array con i nomi
    // dd($squadre);

    foreach ($squadre as $nomeSquadra) {
        Squadra::create([
            'nome' => $nomeSquadra,
        ]);
    }

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Articolo;

use App\Models\Autore;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AutoreSeeder;
use Database\Seeders\ArticoloSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            AutoreSeeder::class,
            ArticoloSeeder::class,
        ]);

         // 2. Recuperiamo gli articoli e gli autori specifici che abbiamo appena creato
        $articoloPower = Articolo::where('titolo', 'the 48 laws of power')->first();
        $articoloWar = Articolo::where('titolo', 'the art of war')->first();
        $articoloPrince = Articolo::where('titolo', 'the prince')->first();

        $autoreOkba = Autore::where('cognome', 'Kharef')->first();
        $autoreMalek = Autore::where('cognome', 'Djelouah')->first();

        // 3. Creiamo le associazioni (popoliamo la tabella pivot 'articolo_autore')

        // Scenario 1: Un articolo con un autore
        // L'articolo 'the 48 laws of power' è scritto da Okba
        if ($articoloPower && $autoreOkba) {
            $articoloPower->autori()->attach($autoreOkba->id);
        }

        // Scenario 2: Un articolo con PIÙ autori
        // L'articolo 'the art of war' è scritto SIA da Okba SIA da Malek
        if ($articoloWar && $autoreOkba && $autoreMalek) {
            // attach() può accettare un array di ID per creare più associazioni
            $articoloWar->autori()->attach([
                $autoreOkba->id,
                $autoreMalek->id,
            ]);
        }

        // Scenario 3: Un autore con PIÙ articoli
        // L'articolo 'the prince' è scritto solo da Malek.
        // Poiché Malek ha scritto anche 'the art of war', ora è associato a due articoli.
        if ($articoloPrince && $autoreMalek) {
            $articoloPrince->autori()->attach($autoreMalek->id);
        }

        
    }
}

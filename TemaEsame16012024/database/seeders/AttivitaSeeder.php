<?php

namespace Database\Seeders;

use App\Models\attivita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttivitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        attivita::factory()->count(10)->create();
    }
}

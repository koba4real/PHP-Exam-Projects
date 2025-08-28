<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Professore Rossi',
                'email' => 'prof@example.com',
                'password' => bcrypt('password'),
                'role' => 'docente',
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action',
            'Comédie',
            'Drame',
            'Horreur',
            'Romance',
            'Science-fiction',
            'Animation',
            'Aventure',
            'Documentaire',
        ];

        foreach ($genres as $name) {
            Genre::create(['name' => $name]);
        }
    }
}

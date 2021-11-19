<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Достоевский Федор Михайлович',
            'biography' => 'Очень крутой писатель'
        ])->ratings()->create([
            'rating' => null
        ]);

        Author::create([
            'name' => 'Чехов Антон Павлович',
            'biography' => 'Тоже очень крутой писатель'
        ])->ratings()->create([
            'rating' => null
        ]);

        Author::create([
            'name' => 'Лондон Джек',
            'biography' => 'Очень суровый писатель'
        ])->ratings()->create([
            'rating' => null
        ]);
    }
}

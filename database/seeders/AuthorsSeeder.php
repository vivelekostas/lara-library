<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
           'name' => 'Достоевский Федор Михайлович',
           'biography' => 'Очень крутой писатель'
        ]);
        DB::table('authors')->insert([
            'name' => 'Чехов Антон Павлович',
            'biography' => 'Тоже очень крутой писатель'
        ]);
        DB::table('authors')->insert([
            'name' => 'Лондон Джек',
            'biography' => 'Очень суровый писатель'
        ]);
    }
}

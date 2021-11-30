<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Author::find(1);
        $author->books()->createMany([
            ['title' => 'Идиот', 'pages' => '892'],
            ['title' => 'Подросток', 'pages' => '762'],
        ]);

        $author = Author::find(2);
        $author->books()->createMany([
            ['title' => 'Чайка', 'pages' => '550'],
            ['title' => 'Убийство', 'pages' => '67']
        ]);

        $author = Author::find(3);
        $author->books()->createMany([
            ['title' => 'Воля к жизни', 'pages' => '457'],
            ['title' => 'Мартин Иден', 'pages' => '687']
        ]);
    }
}

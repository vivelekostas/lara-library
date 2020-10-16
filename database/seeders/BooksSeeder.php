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
        $author->books()->create(['title' => 'Идиот', 'pages' => '892']);
        $author->books()->create(['title' => 'Подросток', 'pages' => '762']);

        $author = Author::find(2);
        $author->books()->create(['title' => 'Чайка', 'pages' => '550']);
        $author->books()->create(['title' => 'Убийство', 'pages' => '67']);

        $author = Author::find(3);
        $author->books()->create(['title' => 'Воля к жизни', 'pages' => '457']);
    }
}

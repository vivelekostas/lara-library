<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = Author::all();
        $authors->each(function ($author) {
            $author->ratings()->create(['rating' => null]);
            $author->books->each(function ($book) {
                $book->ratings()->create(['rating' => null]);
            });
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
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
        $uathor = Author::find(1);
        $uathor->ratings()->create([
            'rating' => null
        ]);
        $uathor = Author::find(2);
        $uathor->ratings()->create([
            'rating' => null
        ]);
        $uathor = Author::find(3);
        $uathor->ratings()->create([
            'rating' => null
        ]);

        $book = Book::find(1);
        $book->ratings()->create([
            'rating' => null
        ]);
        $book = Book::find(2);
        $book->ratings()->create([
            'rating' => null
        ]);
        $book = Book::find(3);
        $book->ratings()->create([
            'rating' => null
        ]);
        $book = Book::find(4);
        $book->ratings()->create([
            'rating' => null
        ]);
        $book = Book::find(5);
        $book->ratings()->create([
            'rating' => null
        ]);
    }
}

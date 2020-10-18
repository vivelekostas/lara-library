<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
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
        Rating::create([
            'entity_id' => $uathor->id,
            'entity_type' => Author::AUTHOR,
            'rating' => null
        ]);
        $uathor = Author::find(2);
        Rating::create([
            'entity_id' => $uathor->id,
            'entity_type' => Author::AUTHOR,
            'rating' => null
        ]);
        $uathor = Author::find(3);
        Rating::create([
            'entity_id' => $uathor->id,
            'entity_type' => Author::AUTHOR,
            'rating' => null
        ]);

        $book = Book::find(1);
        Rating::create([
            'entity_id' => $book->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);
        $book = Book::find(2);
        Rating::create([
            'entity_id' => $book->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);
        $book = Book::find(3);
        Rating::create([
            'entity_id' => $book->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);
        $book = Book::find(4);
        Rating::create([
            'entity_id' => $book->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);
        $book = Book::find(5);
        Rating::create([
            'entity_id' => $book->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);
    }
}

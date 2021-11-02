<?php

namespace App\Services;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BookService
{
    /**
     * Возвращает коллекцию книг c рейтингом (отсортированную или нет), для экшена index.
     * @param BookRequest $request
     * @return Collection
     */
    public function getBooksWithRating(BookRequest $request)
    {
        $booksQuery = Book::booksWithRating(); //тут объект билдер

        if ($request->sort_by) {
            $booksQuery = $booksQuery->orderBy('otsenka', $request->sort_by);
        }

        $books = $booksQuery->get();

        foreach ($books as $book) {
            $rating = round($book->otsenka,1);
            $book->otsenka = $rating;
        }

        return $books;
    }

    /**
     * Сохраняет новую книгу, для экшена store.
     * @param BookRequest $request
     * @return Book
     */
    public function storeNewBook(BookRequest $request): Book
    {
        $newBook = new Book();
        $newBook->fill($request->toArray());
        $newBook->save();

        Rating::create([
            'entity_id' => $newBook->id,
            'entity_type' => Book::BOOK,
            'rating' => null
        ]);

        return $newBook;
    }

    /**
     * Обновляет книгу, для экшена update
     * @param BookRequest $request
     * @param Book $book
     * @return Book
     */

    public function updateBook(BookRequest $request, Book $book): Book
    {
        $book->fill($request->toArray());
        $book->save();

        return $book;
    }

    /**
     * Удаляет книгу для экшена destroy
     * @param $id
     */
    public function destroyBook($id)
    {
        Book::destroy($id);
    }

    /**
     * Возвращает рейтинг книги.
     * @param Book $book
     * @return float|int|mixed
     */
    public function getRating(Book $book)
    {
        $ratingQuery = DB::table('ratings')
            ->where('entity_id', $book->id)
            ->where('entity_type', Book::BOOK)
            ->get();
        $rating = $ratingQuery->avg('rating');

        return $rating;
    }
}

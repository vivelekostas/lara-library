<?php

namespace App\Services;

use App\Events\BookDeleted;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * Возвращает коллекцию книг отсортированную по рейтингу (desc\asc), для экшена index.
     * @param BookRequest $request
     * @return Collection
     */
    public function getBooksByRating(BookRequest $request)
    {
        $books = Book::with('ratings', 'creator')->get();

        foreach ($books as $book) {
            $book->rating = $book->ratings->avg('rating');
            $book->author = $book->creator->name;
        }

        if ($request->sort_by === 'desc') {
            return $books->sortByDesc('rating');
        }

        return $books->sortBy('rating', SORT_NATURAL);
    }

    /**
     * Возвращает книги в алфавитном порядке
     * @return Book[]|Collection
     */
    public function getBooksByTitle()
    {
        $books = Book::with('ratings', 'creator')->get();

        foreach ($books as $book) {
            $book->rating = $book->ratings->avg('rating');
            $book->author = $book->creator->name;
        }

        return $books->sortBy('title', SORT_NATURAL);
    }

    /**
     * Возвращает книгу с её рейтингом и автором.
     * @param $book
     * @return mixed
     */
    public function getBookInfo($book)
    {
        $book->rating = $book->ratings->avg('rating');
        $book->author = $book->creator->name;

        return $book;
    }

    /**
     * Сохраняет новую книгу, добавляя рейтинг. Для экшена store.
     * @param BookRequest $request
     * @return Book
     */
    public function storeNewBook(BookRequest $request): Book
    {
        $newBook = Book::create($request->all());

        $newBook->ratings()->create([
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
        $book->update($request->all());

        return $book;
    }

    /**
     * @param $book
     */
    public function deleteBookWithRaiting($book)
    {
        event(new BookDeleted($book));
        $book->delete();
    }
}

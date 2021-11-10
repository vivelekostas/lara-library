<?php

namespace App\Services;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Traits\RatingTrait;
use Illuminate\Database\Eloquent\Collection;

class BookService
{

    use RatingTrait;

    /**
     * Возвращает коллекцию книг отсортированную по рейтингу (desc\asc), для экшена index.
     * @param BookRequest $request
     * @return Collection
     */
    public function getBooksByRating(BookRequest $request)
    {
        $books = Book::all();

        foreach ($books as $book) {
            $book->rating = $this->getRating($book);
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
        $books = Book::all();

        foreach ($books as $book) {
            $book->rating = $this->getRating($book);
        }

        return $books->sortBy('title', SORT_NATURAL);
    }

    /**
     * Сохраняет новую книгу, для экшена store.
     * @param BookRequest $request
     * @return Book
     */
    public function storeNewBook(BookRequest $request): Book
    {
        $newBook = Book::create($request->toArray());

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
        $book = Book::find($id);
        $book->ratings()->delete();
        $book->delete();
    }
}

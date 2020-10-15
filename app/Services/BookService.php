<?php


namespace App\Services;


use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * Возвращает коллекцию книг, для экшена index.
     * @return Book[]|Collection
     */
    public function getBooks()
    {
        return Book::all();
    }

    /**
     * Сохраняет новую книгу, для экшена store.
     * @param $request
     * @return Book
     */
    public function storeNewAuthor($request)
    {
        $newBook = new Book();
        $newBook->fill($request->toArray());
        $newBook->save();
        return $newBook;
    }

    public function updateBook($request, $book)
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
}

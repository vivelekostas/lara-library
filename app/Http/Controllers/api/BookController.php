<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use App\Traits\RestTrait;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    use RestTrait;

    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Возвращает список книг либо по рейтингу, либо по Названию в алфавитном порядке.
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function index(BookRequest $request): JsonResponse
    {
        if ($request->sort_by) {
            $books = $this->bookService->getBooksByRating($request);

            return $this->getResponse([
                'data' => $books
            ]);
        }

        $books = $this->bookService->getBooksByTitle();

        return $this->getResponse([
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        $newBook = $this->bookService->storeNewBook($request);

        return $this->getResponse([
            'data' => $newBook,
            'message' => 'new book created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        $book->rating = $this->bookService->getRating($book);

        return $this->getResponse([
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        $updateBook = $this->bookService->updateBook($request, $book);

        return $this->getResponse([
            'data' => $updateBook,
            'message' => 'book updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->bookService->destroyBook($book->id);

        return $this->getResponse([
            'message' => 'book deleted successfully'
        ]);
    }
}

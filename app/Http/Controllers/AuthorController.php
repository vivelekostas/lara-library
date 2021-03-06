<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\RestTrait;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    use RestTrait;

    private $authorService;

    // подключаю сервис
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authors = $this->authorService->getAuthors();

        return  $this->getResponse([
            'data' => $authors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return JsonResponse
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        $newAuthor = $this->authorService->storeNewAuthor($request);

        return $this->getResponse([
            'data' => $newAuthor,
            'message' => 'author saved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function show(Author $author): JsonResponse
    {
        $rating = $this->authorService->getRating($author);
        $author->rating = $rating;
        $author->books;

        return $this->getResponse([
            'data' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     * @return JsonResponse
     */

    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        $updatedAuthor = $this->authorService->updateAuthor($request, $author);

        return $this->getResponse([
            'data' => $updatedAuthor,
            'message' => 'author updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        $this->authorService->destroyAuthor($author->id);

        return $this->getResponse([
             'message' => 'author deleted successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\RestTrait;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    use RestTrait;

    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AuthorRequest $request): JsonResponse
    {
        if ($request->sort_by) {
            $authors = $this->authorService->getAuthorsByRating($request);

            return $this->getResponse([
                'data' => $authors
            ]);
        }

        $authors = $this->authorService->getAuthorsByName();

        return $this->getResponse([
            'data' => $authors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        $newAuthor = $this->authorService->storeNewAuthor($request);

        return $this->getResponse([
            'data' => $newAuthor,
            'message' => 'new author created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
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
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        $this->authorService->destroyAuthor($author->id);

        return $this->getResponse([
            'message' => 'author deleted successfully'
        ]);
    }
}

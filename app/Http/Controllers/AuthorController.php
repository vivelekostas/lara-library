<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\RestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use RestTrait;

    public $authorService;

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
    public function index()
    {
        $authors = $this->authorService->getAuthors();
        return  $this->getResponse([
            'data' => $authors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAuthorRequest $request
     * @return JsonResponse
     */
    public function store(StoreAuthorRequest $request)
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
    public function show(Author $author)
    {
        return $this->getResponse([
            'data' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return JsonResponse
     */
    public function update(Request $request, Author $author)
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
    public function destroy(Author $author)
    {
        $this->authorService->destroyAuthor($author->id);
        return $this->getResponse([
             'message' => 'author deleted successfully'
        ]);
    }
}

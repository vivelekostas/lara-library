<?php


namespace App\Services;


use App\Models\Author;

class AuthorService
{
    public function getAuthors()
    {
        return Author::all();
    }

    public function storeNewAuthor($request)
    {
        $author = new Author();
        $author->fill($request->toArray());
        $author->save();
        return $author;
    }
}

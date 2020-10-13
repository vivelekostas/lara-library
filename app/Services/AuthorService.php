<?php


namespace App\Services;


use App\Models\Author;

class AuthorService
{
    public function getAuthors()
    {
        return Author::all();
    }
}

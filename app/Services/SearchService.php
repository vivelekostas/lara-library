<?php


namespace App\Services;


use App\Models\Author;
use App\Models\Book;

class SearchService
{
    public function search($request)
    {
        $searchResult = [];

        if ($request->authors) {
            $authorResult = Author::searchInName($request->key)->get();

            return $searchResult['authors'] = $authorResult;
        }

        if ($request->books) {
            $bookResult = Book::searchInTitle($request->key)->get();

            return $searchResult['books'] = $bookResult;
        }

        $authorResult = Author::searchInName($request->key)->get();
        $bookResult = Book::SearchInTitle($request->key)->get();

        $searchResult['authors'] = $authorResult;
        $searchResult['books'] = $bookResult;

        return $searchResult;
    }
}

<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class SearchService
{
    public function search($request)
    {
        $searchResult = [];

        $authorResult = DB::table('authors',)
            ->where('authors.name', 'like', "%$request->key%")
            ->get();

        $bookResult = DB::table('books')
            ->where('books.title', 'like', "%$request->key%")
            ->get();

        $searchResult['authors'] = $authorResult;
        $searchResult['books'] = $bookResult;

        return $searchResult;
    }
}

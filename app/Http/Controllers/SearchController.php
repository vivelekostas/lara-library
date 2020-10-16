<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = DB::table('authors')
            ->select('authors.id', 'books.id')
            ->join('books', 'authors.id', '=', 'books.creator_id')
            ->where('authors.name', 'like', "%$request->key%")
            ->orWhere('authors.last_name', 'like', "%$request->key%")
            ->orWhere('books.name', 'like', "%$request->key%")
            ->get();

        dd($result);
    }
}

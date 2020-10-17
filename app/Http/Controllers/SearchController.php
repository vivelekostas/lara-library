<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\Traits\RestTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use RestTrait;

    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function __invoke(Request $request)
    {
        $searchResult = $this->searchService->search($request);
        return $this->getResponse([
            'data' => $searchResult
        ]);
    }
}

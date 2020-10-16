<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(RatingRequest $request)
    {
        $rating = new Rating();
        $rating->fill($request->toArray());
        $rating->save();
    }
}

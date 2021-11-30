<?php

namespace App\Listeners;

use App\Events\AuthorDeleted;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveAuthorAndHisBooksRatings
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AuthorDeleted  $event
     * @return void
     */
    public function handle(AuthorDeleted $event)
    {
        $bookId = $event->author->books->modelKeys();
        Rating::whereIn('ratingable_id', $bookId)->where('ratingable_type', Book::class)->delete();
        Rating::getRatingsOfEntity($event->author)->delete();
    }
}

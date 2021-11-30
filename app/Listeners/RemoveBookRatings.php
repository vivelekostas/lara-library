<?php

namespace App\Listeners;

use App\Events\BookDeleted;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveBookRatings
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
     * @param  BookDeleted  $event
     * @return void
     */
    public function handle(BookDeleted $event)
    {
        Rating::getRatingsOfEntity($event->book)->delete();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static booksWithRating()
 */
class Book extends Model
{
    use HasFactory;

    public const BOOK = 2;

    protected $fillable = ['title', 'pages', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo('App\Models\Author', 'creator_id');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function scopeSearchInTitle($query, $needle)
    {
        $query->where('title', 'like', "%$needle%");
    }
}

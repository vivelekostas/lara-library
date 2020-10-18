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

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeBooksWithRating(Builder $query)
    {
        return $query->select(DB::raw('`books`.`id`, `books`.`title`, `books`.`pages`, AVG(`rating`) as otsenka'))
            ->leftJoin('ratings', 'books.id', '=', 'ratings.entity_id')
            ->where('ratings.entity_type', '=', self::BOOK)
            ->groupBy('books.title');
    }
}

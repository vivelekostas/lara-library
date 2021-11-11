<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public const AUTHOR = 1;

    protected $fillable = ['name', 'biography'];

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'creator_id');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function scopeSearchInName($query, $needle)
    {
        $query->where('name', 'like', "%$needle%");
    }
}

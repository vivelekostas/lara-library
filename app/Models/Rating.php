<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['ratingable_id', 'ratingable_type', 'rating'];

    public function ratingable()

    {
        return $this->morphTo();
    }

    public function scopeGetRatingsOfEntity($query, $model)
    {
        $query->where('ratingable_id', $model->id)
            ->where('ratingable_type', $model->getMorphClass());
    }
}

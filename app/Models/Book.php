<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public const BOOK = 2;

    protected $fillable = ['name', 'pages', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo('App\Models\Author', 'creator_id');
    }
}

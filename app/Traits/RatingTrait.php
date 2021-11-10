<?php


namespace App\Traits;

trait RatingTrait
{
    /**
     * Возвращает рейтинг модели.
     * @param $model
     * @return float
     */
    public function getRating($model)
    {
        return round($model->ratings()->avg('rating'), 2);
    }
}

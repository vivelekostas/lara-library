<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * для форматирования ответов контроллеров
 * Trait RestTrait
 * @package App\Traits
 */
trait RestTrait
{
//    public function getResponse($data, $httpStatus = 200): JsonResponse
    public function getResponse($data, $httpStatus = 200)
    {
        return Response::json($data, $httpStatus);
    }
}

<?php


namespace App\Services;


use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Обслуживает AuthorController.
 * Class AuthorService
 * @package App\Services
 */
class AuthorService
{
    /**
     * Возвращает коллекцию авторов, для экшена index.
     * @return Author[]|Collection
     */
    public function getAuthors()
    {
        return Author::all();
    }

    /**
     * Сохраняет нового автора, для экшена store.
     * @param AuthorRequest $request
     * @return Author
     */
    public function storeNewAuthor(AuthorRequest $request): Author
    {
        $newAuthor = new Author();
        $newAuthor->fill($request->toArray());
        $newAuthor->save();

        Rating::create([
            'entity_id' => $newAuthor->id,
            'entity_type' => Author::AUTHOR,
            'rating' => null
        ]);

        return $newAuthor;
    }

    /**
     * Обновляет данные атора, для экшена update.
     * @param AuthorRequest $request
     * @param Author $author
     * @return Author
     */
    public function updateAuthor(AuthorRequest $request, Author $author): Author
    {
        $author->fill($request->toArray());
        $author->save();

        return $author;
    }

    /**
     * Удаляет автора для экшена destroy
     * @param $id
     */
    public function destroyAuthor($id)
    {
        Author::destroy($id);
    }

    /**
     * ВОзвращает рейтинг автора.
     * @param Author $author
     * @return float|int|mixed
     */
    public function getRating(Author $author)
    {
        $ratingQuery = DB::table('ratings')
            ->where('entity_id', $author->id)
            ->where('entity_type', Author::AUTHOR)
            ->get();
        $rating = $ratingQuery->avg('rating');

        return $rating;
    }
}

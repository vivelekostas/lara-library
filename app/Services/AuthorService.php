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
        $newAuthor = Author::create($request->toArray());

        $newAuthor->ratings()->create([
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
//    public function destroyAuthor($author)
    {
//        dump('удаление!');
//        dump($id);

//        $author = Author::find($id);
//        dump($author);
//        dump($author->ratings);
//       $ratings = $author->ratings;
//       $ratingsId = $ratings->pluck('id');
//       DB::table('ratings')
//           ->whereIn('id', $ratingsId->toArray())
//           ->where('ratingable_type', Author::class)
//           ->delete();

//       dump($ratingsId);

//        die();
//        Author::destroy($id);
    }

    /**
     * ВОзвращает рейтинг автора.
     * @param Author $author
     * @return float|int|mixed
     */
    public function getRating(Author $author)
    {
        return round($author->ratings()->avg('rating'),2);
    }
}

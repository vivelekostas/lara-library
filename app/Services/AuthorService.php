<?php


namespace App\Services;

use App\Events\AuthorDeleted;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Traits\RatingTrait;
use Illuminate\Database\Eloquent\Collection;


class AuthorService
{

    use RatingTrait;

    /**
     * Возвращает кол-цию авторов отсоритрованных по рейтингу, для экшена index.
     * @return Author[]|Collection
     */
    public function getAuthorsByRating($request)
    {
        $authors = Author::all();

        foreach ($authors as $author) {
            $author->rating = $this->getRating($author);
        }

        if ($request->sort_by === 'desc') {
            return $authors->sortByDesc('rating');
        }

        return $authors->sortBy('rating', SORT_NATURAL);
    }

    /**
     * Возвращает авторов в алфавитном порядке
     * @return Author[]|Collection
     */
    public function getAuthorsByName()
    {
        $authors = Author::all();

        foreach ($authors as $author) {
            $author->rating = $this->getRating($author);
        }

        return $authors->sortBy('name', SORT_NATURAL);
    }

    /**
     * Возвращает автора с его рейтингом и книгами.
     * @param $author
     * @return mixed
     */
    public function getAuthorInfo($author)
    {
        $rating = $this->getRating($author);
        $author->rating = $rating;
        $author->books;

        return $author;
    }

    /**
     * Сохраняет нового автора и добавляет ему рейтинг. Для экшена store.
     * @param AuthorRequest $request
     * @return Author
     */
    public function storeNewAuthor(AuthorRequest $request): Author
    {
        $newAuthor = Author::create($request->all());

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
        $author->update($request->all());

        return $author;
    }

    /**
     * @param $author
     */
    public function deleteAuthorsWithBooksAndRaitings($author)
    {
        event(new AuthorDeleted($author));
        $author->delete();
    }
}

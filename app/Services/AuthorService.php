<?php


namespace App\Services;


use App\Models\Author;

/**
 * Обслуживает AuthorController.
 * Class AuthorService
 * @package App\Services
 */
class AuthorService
{
    /**
     * Возвращает коллекцию авторов, для экшена index.
     * @return Author[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAuthors()
    {
        return Author::all();
    }

    /**
     * Сохраняет нового автора, для экшена store.
     * @param $request
     * @return Author
     */
    public function storeNewAuthor($request)
    {
        $newAuthor = new Author();
        $newAuthor->fill($request->toArray());
        $newAuthor->save();
        return $newAuthor;
    }

    /**
     * Обновляет данные атора, для экшена update.
     * @param $request
     * @param $author
     * @return Author
     */
    public function updateAuthor($request, $author)
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
}

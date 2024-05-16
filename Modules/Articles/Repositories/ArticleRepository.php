<?php

namespace Modules\Articles\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Modules\Articles\Entities\Article;
use Modules\Articles\Http\Filters\ArticleFilter;
use Modules\Contracts\CrudRepository;

class ArticleRepository implements CrudRepository
{
    private ArticleFilter $filter;

    /**
     * ArticleRepository constructor.
     * @param ArticleFilter $filter
     */
    public function __construct(ArticleFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return Article::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $article = Article::create($data);

        $article->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $article;
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find($model)
    {
        if ($model instanceof Article) {
            return $model;
        }

        return Article::findOrFail($model);
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return Model|Article|void
     */
    public function update($model, array $data)
    {
        $article = $this->find($model);

        if (!empty($article)) {
            $article->update($data);
        }

        $article->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $article;
    }

    /**
     * @param mixed $model
     * @throws Exception
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }
}

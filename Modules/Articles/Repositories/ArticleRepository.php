<?php

namespace Modules\Articles\Repositories;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Modules\Articles\Entities\Article;
use Illuminate\Database\Eloquent\Model;
use Modules\Articles\Http\Filters\ArticleFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function all(): LengthAwarePaginator
    {
        return Article::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array|Request|DataTransferObjects $data): Article|Model
    {
        $article = Article::create($data);

        $article->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $article;
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find(int|Model $model): array|Article|Collection|Model
    {
        if ($model instanceof Article) {
            return $model;
        }

        return Article::findOrFail($model);
    }

    /**
     * @param int|Model $model
     * @param array|Request|DataTransferObjects $data
     * @return Model|Article|void
     */
    public function update(int|Model $model, array|Request|DataTransferObjects $data): array|Article|Collection|Model
    {
        $article = $this->find($model);

        if (!empty($article)) {
            $article->update($data);
        }

        $article->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $article;
    }

    /**
     * @param int|Model $model
     * @throws Exception
     */
    public function delete(int|Model $model): void
    {
        $this->find($model)->delete();
    }
}

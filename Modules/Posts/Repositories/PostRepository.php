<?php

namespace Modules\Posts\Repositories;

use Exception;
use Illuminate\Http\Request;
use Modules\Posts\Entities\Post;
use Illuminate\Support\Collection;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Http\Filters\PostFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements CrudRepository
{
  private PostFilter $filter;

  /**
   * PostRepository constructor.
   * @param PostFilter $filter
   */
  public function __construct(PostFilter $filter)
  {
    $this->filter = $filter;
  }

  /**
   * @return LengthAwarePaginator
   */
  public function all(): LengthAwarePaginator
  {
    return Post::filter($this->filter)->paginate(request('perPage'));
  }

  /**
   * @param array $data
   * @return Model
   */
  public function create(array|Request|DataTransferObjects $data): Post|Model
  {
    $post = Post::create($data);

    $post->addAllMediaFromTokens($data['image'] ?? [], 'default');

    return $post;
  }

  /**
   * @param mixed $model
   * @return Model|void
   */
  public function find(int|Model $model): array|Post|Collection|Model
  {
    if ($model instanceof Post) {
      return $model;
    }

    return Post::findOrFail($model);
  }

  /**
   * @param int|Model $model
   * @param array|Request|DataTransferObjects $data
   * @return Model|Post|void
   */
  public function update(int|Model $model, array|Request|DataTransferObjects $data): array|Post|Collection|Model
  {
    $post = $this->find($model);

    if (!empty($post)) {
      $post->update($data);
    }

    $post->addAllMediaFromTokens($data['image'] ?? [], 'default');

    return $post;
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

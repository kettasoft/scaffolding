<?php

namespace Modules\Pages\Repositories;

use Exception;
use Illuminate\Http\Request;
use Modules\Pages\Entities\Page;
use Illuminate\Support\Collection;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;
use Modules\Pages\Http\Filters\PageFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PageRepository implements CrudRepository
{
    private $filter;

    /**
     * PageRepository constructor.
     * @param PageFilter $filter
     */
    public function __construct(PageFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return Page::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * @param array|Request|DataTransferObjects $data
     * @return Model|Page
     */
    public function create(array|Request|DataTransferObjects $data): Model|Page
    {
        $page = Page::create($data);

        return $page;
    }

    /**
     * @param int|Model $model
     * @return array|Collection|Model|Page
     */
    public function find(int|Model $model): array|Collection|Model|Page
    {
        if ($model instanceof Page) {
            return $model;
        }

        return Page::findOrFail($model);
    }

    /**
     * @param int|Model $model
     * @param array|Request|DataTransferObjects $data
     * @return Model|Page|void
     */
    public function update(int|Model $model, array|Request|DataTransferObjects $data)
    {
        $page = $this->find($model);

        $page->update($data);

        return $page;
    }

    /**
     * @param int|Model $model
     * @throws Exception
     */
    public function delete(int|Model $model)
    {
        $this->find($model)->delete();
    }
}

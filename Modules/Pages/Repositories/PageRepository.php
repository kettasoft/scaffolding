<?php

namespace Modules\Pages\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Modules\Contracts\CrudRepository;
use Modules\Pages\Entities\Page;
use Modules\Pages\Http\Filters\PageFilter;

class PageRepository implements CrudRepository
{
    private $filter;

    /**
     * ProductRepository constructor.
     * @param PageFilter $filter
     */
    public function __construct(PageFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return Page::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $page = Page::create($data);

        return $page;
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find($model)
    {
        if ($model instanceof Page) {
            return $model;
        }

        return Page::findOrFail($model);
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return Model|Page|void
     */
    public function update($model, array $data)
    {
        $page = $this->find($model);

        $page->update($data);

        return $page;
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

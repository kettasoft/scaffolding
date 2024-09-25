<?php

namespace Modules\Contracts;

use Illuminate\Http\Request;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;

interface CrudRepository
{
    /**
     * Get all models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Save the created model to storage.
     *
     * @param array|Request|DataTransferObjects $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array|Request|DataTransferObjects $data);

    /**
     * Display the given model instance.
     *
     * @param int|Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int|Model $model);

    /**
     * Update the given model in the storage.
     *
     * @param int|Model $model
     * @param array|Request|DataTransferObjects $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int|Model $model, array|Request|DataTransferObjects $data);

    /**
     * Delete the given model from storage.
     *
     * @param int|Model $model
     * @return void
     */
    public function delete(int|Model $model);
}

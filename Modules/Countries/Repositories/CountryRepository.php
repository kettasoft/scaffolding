<?php

namespace Modules\Countries\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\CountryFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountryRepository implements CrudRepository
{
    /**
     * @var \Modules\Countries\Http\Filters\CountryFilter
     */
    private $filter;

    /**
     * CountryRepository constructor.
     *
     * @param \Modules\Countries\Http\Filters\CountryFilter $filter
     */
    public function __construct(CountryFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all countries as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return Country::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array|Request|DataTransferObjects $data
     * @return \Modules\Countries\Entities\Country
     */
    public function create(array|Request|DataTransferObjects $data): Country
    {
        /** @var Country $country */
        $country = Country::create($data);

        $country->addAllMediaFromTokens($data['flag'] ?? [], 'flags');

        return $country;
    }

    /**
     * Display the given country instance.
     *
     * @param int|Model $model
     * @return \Modules\Countries\Entities\Country
     */
    public function find(int|Model $model): array|Collection|Country|Model
    {
        if ($model instanceof Country) {
            return $model;
        }

        return Country::findOrFail($model);
    }

    /**
     * Update the given country in the storage.
     *
     * @param int|Model $model
     * @param array|Request|DataTransferObjects $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int|Model $model, array|Request|DataTransferObjects $data): array|Collection|Country|Model
    {
        $country = $this->find($model);

        $country->update($data);

        $country->addAllMediaFromTokens($data['flag'] ?? [], 'flags');

        return $country;
    }

    /**
     * Delete the given country from storage.
     *
     * @param int|Model $model
     * @return void
     * @throws \Exception
     */
    public function delete(int|Model $model)
    {
        $this->find($model)->delete();
    }
}

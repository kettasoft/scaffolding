<?php

namespace Modules\Settings\Repositories;

use Illuminate\Http\Request;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Modules\Settings\Entities\Setting;

class SettingRepository implements CrudRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        //
    }

    /**
     * @param array|Request|DataTransferObjects $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array|Request|DataTransferObjects $data)
    {
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }
    }

    /**
     * @param mixed $model
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function find($model)
    {
        //
    }

    /**
     * @param mixed $model
     * @param array|Request|DataTransferObjects $data
     */
    public function update($model, array|Request|DataTransferObjects $data)
    {
        //
    }

    /**
     * @param mixed $model
     */
    public function delete($model)
    {
        //
    }
}

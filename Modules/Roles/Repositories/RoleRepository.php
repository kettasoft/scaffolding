<?php

namespace Modules\Roles\Repositories;

use Exception;
use Illuminate\Http\Request;
use Modules\Roles\Entities\Role;
use Illuminate\Support\Collection;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;
use Modules\Roles\Http\Filters\RoleFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleRepository implements CrudRepository
{
    private $filter;

    /**
     * RoleRepository constructor.
     * @param RoleFilter $filter
     */
    public function __construct(RoleFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return Role::whereRoleNot(['user'])->filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * @param array|Request|DataTransferObjects $data
     * @return Model|Role
     */
    public function create(array|Request|DataTransferObjects $data): Model|Role
    {
        $role = Role::create($data);
        $role->givePermissions($data['permissions']);

        return $role;
    }

    /**
     * @param int|Model $model
     * @return Model|void
     */
    public function find($model): array|Collection|Model|Role
    {
        if ($model instanceof Role) {
            return $model;
        }

        return Role::findOrFail($model);
    }

    /**
     * @param int|Model $model
     * @param array|Request|DataTransferObjects $data
     * @return Model|Role|void
     */
    public function update($model, array|Request|DataTransferObjects $data): array|Collection|Model|Role
    {
        $role = $this->find($model);

        if (!empty($role)) {
            $role->update($data);
        }
        $role->syncPermissions($data['permissions']);

        return $role;
    }

    /**
     * @param int|Model $model
     * @throws Exception
     */
    public function delete($model): void
    {
        $this->find($model)->delete();
    }
}

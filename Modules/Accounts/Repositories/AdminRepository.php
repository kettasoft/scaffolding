<?php

namespace Modules\Accounts\Repositories;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Accounts\Entities\Admin;
use Modules\Contracts\CrudRepository;
use App\Abstracts\DataTransferObjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Http\Filters\AdminFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminRepository implements CrudRepository
{
    /**
     * @var AdminFilter
     */
    private $filter;

    /**
     * AdminRepository constructor.
     *
     * @param AdminFilter $filter
     */
    public function __construct(AdminFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all clients as a collection.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        if (\Module::collections()->has('Roles')) {
            return Admin::where('email', '!=', 'root@demo.com')->filter($this->filter)->paginate(request('perPage'));
        }

        return Admin::where('email', '!=', 'admin@demo.com')->where('email', '!=', 'root@demo.com')->filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array|Request|DataTransferObjects $data
     * @return Admin|Model
     */
    public function create(array|Request|DataTransferObjects $data): Admin|Model
    {
        $admin = Admin::create($data);

        $this->setType($admin, $data);
        if (\Module::collections()->has('Roles')) {
            $admin->addRoles([$data['role_id']]);
        }

        $admin->setVerified();

        $admin->addAllMediaFromTokens($data['avatar'] ?? [], 'avatars');

        return $admin;
    }

    /**
     * Display the given client instance.
     *
     * @param int|Model $model
     * @return Admin
     */
    public function find(int|Model $model): Admin|array|Collection|Model
    {
        if ($model instanceof Admin) {
            return $model;
        }

        return Admin::findOrFail($model);
    }

    /**
     * Update the given client in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return Model
     */
    public function update(int|Model $model, array|Request|DataTransferObjects $data): Admin|array|Collection|Model
    {
        $admin = $this->find($model);

        $admin->update($data);

        $this->setType($admin, $data);

        if (\Module::collections()->has('Roles')) {
            $admin->syncRoles([$data['role_id']]);
        }

        $admin->addAllMediaFromTokens($data['avatar'] ?? [], 'avatars');

        if (auth()->id() == $admin->id) {
            Session::put('locale', $admin->preferred_locale ?? app()->getLocale());
        }

        return $admin;
    }

    /**
     * Delete the given client from storage.
     *
     * @param int|Model $model
     * @return void
     * @throws Exception
     */
    public function delete(int|Model $model): void
    {
        $this->find($model)->delete();
    }

    /**
     * Set the client type.
     *
     * @param Admin $admin
     * @param array $data
     * @return Admin
     */
    private function setType(Admin $admin, array $data): Admin
    {
        if (isset($data['type'])) {
            $admin->setType($data['type']);
        }

        return $admin;
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function block(Admin $admin): Admin
    {
        $admin->block()->save();

        return $admin;
    }

    /**
     * @param Admin $admin
     * @return Admin
     */
    public function unblock(Admin $admin): Admin
    {
        $admin->unblock()->save();

        return $admin;
    }
}

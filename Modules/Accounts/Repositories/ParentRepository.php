<?php

namespace Modules\Accounts\Repositories;

use Modules\Contracts\CrudRepository;
use Modules\Accounts\Entities\ParentModel;
use Modules\Accounts\Http\Filters\ParentFilter;

class ParentRepository implements CrudRepository
{
    /**
     * @var \Modules\Accounts\Http\Filters\ParentFilter
     */
    private $filter;

    /**
     * ParentRepository constructor.
     *
     * @param \Modules\Accounts\Http\Filters\ParentFilter $filter
     */
    public function __construct(ParentFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all clients as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return ParentModel::where('email', '!=', 'guest@guest.com')->filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Modules\Accounts\Entities\ParentModel
     */
    public function create(array $data)
    {
        $parent = ParentModel::create($data);

        if ($parent->exists) {
            $this->setType($parent, $data);
        }

        $parent->setVerified();

        $parent->addAllMediaFromTokens($data['avatar'] ?? [], 'avatars');

        return $parent;
    }

    /**
     * Display the given client instance.
     *
     * @param mixed $model
     * @return \Modules\Accounts\Entities\ParentModel
     */
    public function find($model)
    {
        if ($model instanceof ParentModel) {
            return $model;
        }

        return ParentModel::findOrFail($model);
    }

    /**
     * Update the given client in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $parent = $this->find($model);

        $parent->update($data);

        $this->setType($parent, $data);

        $parent->addAllMediaFromTokens($data['avatar'] ?? [], 'avatars');

        return $parent;
    }

    /**
     * Delete the given client from storage.
     *
     * @param mixed $model
     * @return void
     * @throws \Exception
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }

    /**
     * Set the client type.
     *
     * @param \Modules\Accounts\Entities\ParentModel $parent
     * @param array $data
     * @return \Modules\Accounts\Entities\ParentModel
     */
    private function setType(ParentModel $parent, array $data)
    {
        if (isset($data['type'])) {
            $parent->setType($data['type'] ?? 'parent');
        }

        return $parent;
    }

    /**
     * @param ParentModel $parent
     * @return ParentModel
     */
    public function block(ParentModel $parent)
    {
        $parent->block()->save();

        return $parent;
    }

    /**
     * @param ParentModel $parent
     * @return ParentModel
     */
    public function unblock(ParentModel $parent)
    {
        $parent->unblock()->save();

        return $parent;
    }
}

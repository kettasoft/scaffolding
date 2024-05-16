<?php

namespace Modules\Accounts\Entities;

use Modules\Accounts\Entities\Scopes\AdminScopes;
use Modules\Accounts\Transformers\AdminResource;
use Parental\HasParent;

class Admin extends User
{
    use HasParent, AdminScopes;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }

    /**
     * Get the resource for admin type.
     *
     * @return \Modules\Accounts\Transformers\AdminResource
     */
    public function getResource()
    {
        return new AdminResource($this);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\AdminFactory::new();
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return route('dashboard.admins.show', $this);
    }
}

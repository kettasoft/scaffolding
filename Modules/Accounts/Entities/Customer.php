<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Database\factories\CustomerFactory;
use Modules\Accounts\Entities\Relations\CustomerRelations;
use Modules\Accounts\Entities\Scopes\CustomerScopes;
use Modules\Accounts\Transformers\CustomerResource;
use Modules\Addresses\Entities\Relations\HasManyAddresses;
use Modules\Support\Traits\Favorable;
use Parental\HasParent;

class Customer extends User
{
    use HasParent, CustomerRelations, HasFactory, CustomerScopes;

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
     * Get the resource for customer type.
     *
     * @return CustomerResource
     */
    public function getResource()
    {
        return new CustomerResource($this);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return '#';
    }
}

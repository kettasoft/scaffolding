<?php

namespace Modules\Accounts\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Children\Entities\Child;

trait ParentRelations
{
    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }
}

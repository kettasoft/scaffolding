<?php

namespace Modules\Accounts\Entities\Relations;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Accounts\Entities\Verification;

trait CustomerRelations
{
    /**
     * @return HasOne
     */
    public function verify(): HasOne
    {
        return $this->hasOne(Verification::class);
    }
}

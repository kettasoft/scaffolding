<?php

namespace Modules\Posts\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Entities\User;

trait PostRelations
{
  /**
   * Get the user that owns the PostRelations
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}

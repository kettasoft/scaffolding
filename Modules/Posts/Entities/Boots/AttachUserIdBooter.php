<?php

namespace Modules\Posts\Entities\Boots;

use Scaffolding\Booter\Contracts\HasBooterContract;

class AttachUserIdBooter implements HasBooterContract
{
  public function handle(\Illuminate\Database\Eloquent\Model $model)
  {
    $model->user_id = auth()->id();
  }
}

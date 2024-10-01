<?php

namespace Modules\Articles\Boots;

use Scaffolding\Booter\Contracts\HasBooterContract;

class AttachAutherIdBoot implements HasBooterContract
{
  public function handle($model): void
  {
    dd($model);
  }
}
<?php


namespace Modules\Accounts\Entities\Scopes;

trait CustomerScopes
{
    public function scopeInRequest($query, $request)
    {
        return self::where('phone', $request->input('phone'));
    }
}

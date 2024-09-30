<?php

namespace App\Traits;

use App\Abstracts\NewEloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;

trait HasCountCache
{
    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new NewEloquentBuilder($query);
    }

    public static function boot()
    {
        parent::boot();

        static::created(fn(): bool|int => Cache::increment('count_' . static::class));

        static::deleted(fn(): bool|int => Cache::decrement('count_' . static::class));
    }
}

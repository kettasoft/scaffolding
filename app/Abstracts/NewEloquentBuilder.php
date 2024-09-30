<?php

namespace App\Abstracts;

use Illuminate\Database\Eloquent\Builder;

class NewEloquentBuilder extends Builder
{
    /**
     * Get the count of the cache entries.
     * @return int
     */
    public function count()
    {
        return parent::count();
        // Check if the count is already cached
        if (cache()->has('count_' . static::class)) {
            return cache()->get('count_' . static::class);
        }

        // If not, fetch the count from the database and cache it for future use
        // The cache will automatically expire after 1 hour (60 minutes)
        // This is useful for reducing database load and improving performance when dealing with large datasets
        cache()->set('count_' . static::class, parent::count());

        // If the count is still not cached after checking the cache, fetch it from the database and cache it forever
        // This is useful for reducing database load and improving performance when dealing with very large datasets
        // However, this may consume more memory if the cache does not expire quickly enough
        // Consider using the 'count_' cache in conjunction with other caching strategies to optimize memory usage and performanc
    }
}

<?php

namespace App\Providers;

use Modules\Accounts\Entities\User;
use Illuminate\Support\ServiceProvider;
use Modules\Accounts\Entities\Observers\EmailVerificationObserver;

class ObserversServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        User::observe(EmailVerificationObserver::class);
    }
}

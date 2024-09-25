<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Modules\Accounts\Events\VerificationCreated;
use Modules\Accounts\Events\ResetPasswordCreated;
use Modules\Accounts\Listeners\SendVerificationCode;
use Modules\Accounts\Listeners\SendResetPasswordCode;
use Modules\TFA\Listeners\TowFactorAuthenticationListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Login::class => [
            //
        ],

        VerificationCreated::class => [
            SendVerificationCode::class,
        ],

        ResetPasswordCreated::class => [
            SendResetPasswordCode::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

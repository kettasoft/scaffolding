<?php

namespace Modules\Accounts\Http\Controllers\Socialite\Drivers;

use Laravel\Socialite\Facades\Socialite;
use Modules\Accounts\Contracts\HasSocialiteDriverCallbackContract;
use Modules\Accounts\Http\Controllers\Socialite\SetSocialiteDriverController;

class GoogleSocialiteController extends SetSocialiteDriverController implements HasSocialiteDriverCallbackContract
{
    /**
     * Handle google callback.
     */
    public function callback()
    {
        $user = Socialite::driver('google')->user();

        // User::createOrFirst();
    }
}

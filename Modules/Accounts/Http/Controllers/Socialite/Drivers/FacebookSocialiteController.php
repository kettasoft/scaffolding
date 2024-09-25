<?php

namespace Modules\Accounts\Http\Controllers\Socialite\Drivers;

use Laravel\Socialite\Facades\Socialite;
use Modules\Accounts\Contracts\HasSocialiteDriverCallbackContract;
use Modules\Accounts\Http\Controllers\Socialite\SetSocialiteDriverController;
use Modules\Accounts\Http\Controllers\Socialite\SocialiteAbstractController;

class FacebookSocialiteController extends SetSocialiteDriverController implements HasSocialiteDriverCallbackContract
{
    /**
     * Handle google callback.
     */
    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
    }
}

<?php

namespace Modules\Accounts\Http\Controllers\Socialite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SetSocialiteDriverController extends Controller
{
    /**
     * Handle the incoming driver request.
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        if ($this->checkAvailableDrivers($request)) {
            return Socialite::driver($request->driver)->redirect();
        }

        throw new \InvalidArgumentException("The driver ({$request->driver}) is not available.");
    }

    /**
     * Check available drivers for a given driver type.
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function checkAvailableDrivers(Request $request): bool
    {
        return config()->has("services.{$request->driver}");
    }
}

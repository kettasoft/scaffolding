<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\User;
use Modules\Accounts\Http\Requests\Api\RegisterRequest;
use Modules\Support\Traits\ApiTrait;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * Handle a login request to the application.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->allWithHashedPassword());

        if ($request->avatar) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        event(new Registered($user));

        if ($request->type === 'provider') {
            $user->setType(User::PROVIDER_TYPE);
        } else {
            $user->setType(User::PARENT_TYPE);
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }
}

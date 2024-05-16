<?php

namespace Modules\Accounts\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laracasts\Presenter\Exceptions\PresenterException;
use Modules\Accounts\Entities\Customer;

/** @mixin Customer */
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     * @throws PresenterException
     */
    public function toArray($request)
    {
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'email'                => $this->email,
            'phone'                => $this->phone,
            'type'                 => $this->present()->type,
            'avatar'               => $this->getAvatar(),
            'device_token'         => $this->device_token,
            'preferred_locale'     => $this->preferred_locale,
            'token'                => $this->createTokenForDevice($request->device_name),
            'reset_token'          => $this->reset_token ?: '',
            'verified'             => $this->hasVerifiedEmail(),
            'verified_at'          => $this->email_verified_at ? $this->email_verified_at->toDateTimeString() : '',
            'created_at'           => $this->created_at->toDateTimeString(),
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}

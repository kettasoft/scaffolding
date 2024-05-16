<?php

namespace Modules\Settings\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Laraeast\LaravelSettings\Facades\Settings;

class ContactSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => Settings::get('email'),
            'phone' => Settings::get('phone'),
            'WhatsApp_number' => Settings::get('whats_app'),
        ];
    }
}

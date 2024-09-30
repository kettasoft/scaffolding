<?php

namespace App\Integrations\Notifications;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    /**
     * Send whatsapp notifications
     * @param string $phone
     * @param string $content
     * @param array $parameters
     * @param string $language
     * @return void
     */
    public static function send(string $phone, string $content, array $parameters = [], string $language = 'en'): string
    {
        $token = config('services.whatsapp.token');
        $channelId = config('services.whatsapp.channelId');
        $endpoint = config('services.whatsapp.endpoint');

        $data = [
            "phone" =>  $phone,
            "channelId" =>  $channelId,
            "templateName" =>  "authentication",
            "languageCode" =>  $language,
            "text" =>  $content,
            "parameters" =>  $parameters,
            "tags" =>  [
                "api",
                "test"
            ]
        ];

        $data = json_encode($data);

        $response = Http::withBody($data, 'application/json')
            ->withToken($token)
            ->post($endpoint);

        return $response->body();
    }
}

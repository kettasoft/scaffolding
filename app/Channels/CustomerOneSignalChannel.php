<?php


namespace App\Channels;


use Berkayk\OneSignal\OneSignalClient;
use NotificationChannels\OneSignal\OneSignalChannel;

class CustomerOneSignalChannel extends OneSignalChannel
{
    public function __construct()
    {
        $oneSignal = new OneSignalClient(
            config('services.customerOneSignal.app_id'),
            config('services.customerOneSignal.rest_api_key'),
            null);
        parent::__construct($oneSignal);
    }
}

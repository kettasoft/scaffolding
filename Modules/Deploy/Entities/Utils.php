<?php


namespace Modules\Deploy\Entities;

use Error;
use Illuminate\Support\Facades\Mail;
use Modules\Deploy\Emails\Notification;

class Utils
{
    /**
     * Verify Github X-Hub-Signature with user's secret token.
     *
     * @param $body
     * @param $github_signature
     * @return bool
     */
    public static function githubVerify($body, $github_signature)
    {
        $signature = 'sha1=' . hash_hmac('sha1', $body, config('deploy.tokens.github'));

        return $signature === $github_signature;
    }

    /**
     * Send email to subscribers after deployment.
     *
     * @return null
     */
    public static function sendNotifications()
    {
        $view = config('deploy.notifications.template');
        $emails = config('deploy.notifications.recipients');

        if (!$view) return null;
        if (!$emails) throw new Error('Invalid email(s) address');

        Mail::to($emails)->send(new Notification($view));
    }
}

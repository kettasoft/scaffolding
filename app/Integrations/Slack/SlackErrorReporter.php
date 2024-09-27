<?php

namespace App\Integrations\Slack;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SlackErrorReporter
{
    protected string $webhook;
    protected \Throwable $exception;
    /**
     * SlackErrorReporter __construct
     */
    public function __construct(\Throwable $exception)
    {
        $this->exception = $exception;
        $this->webhook = env('SLACK_WEBHOOK_URL');
    }

    /**
     * Send the error message to the slack.
     * @return void
     */
    public function send()
    {
        if (is_null($this->webhook) && env('SLACK_WEBHOOK_ENABLE')) {
            return;
        }

        try {
            Http::post($this->webhook, $this->segnature($this->exception));
        } catch (\Exception $e) {
            Log::error('Failed to send Slack notification: ' . $e->getMessage());
        }
    }

    /**
     * Return the exception segnature.
     * @param \Throwable $exception
     * @return array
     */
    protected function segnature(\Throwable $exception): array
    {
        return [
            'text' => sprintf(
                "Exception occurred in %s:\n%s\n\nFile: %s\nLine: %d",
                $exception->getFile(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine()
            ),
        ];
    }
}

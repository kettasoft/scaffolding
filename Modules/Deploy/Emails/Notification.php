<?php

namespace Modules\Deploy\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view)
    {
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
            ->subject(config('app.name') . ' auto deploy notification');
    }
}

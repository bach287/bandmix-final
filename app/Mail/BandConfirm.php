<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BandConfirm extends Mailable
{
    use Queueable, SerializesModels;
    public $event_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event_name)
    {
        //
        $this->event_name = $event_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.confirm_band');
    }
}

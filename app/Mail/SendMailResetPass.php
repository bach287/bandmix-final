<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailResetPass extends Mailable
{
    use Queueable, SerializesModels;
    public $new_pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_pass)
    {
        //
        $this->new_pass = $new_pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reset_pass');
    }
}

<?php

namespace App\Notifications;

use App\Entities\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoicePaid extends Notification
{
    use Queueable;

    protected $band;
    protected $event;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($band, $event)
    {
        $this->band = $band;
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
//        dd($notifiable);
        return [
            'user' => $notifiable,
            'band' => $this->band,
            'event' => $this->event,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

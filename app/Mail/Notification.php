<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    private $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $this->subject('Erro - Central Windx');
//        $this->to('supwindx@gmail.com', 'Admin');
//        return $this->view('emails.notification', [
//            'notification' => $this->notification
//        ]);

        return $this->markdown('emails.notification', [
            'notification' => $this->notification,
        ])->subject('Erro - Central Windx');
    }
}

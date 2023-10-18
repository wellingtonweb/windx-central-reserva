<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset', [
            'customer_id' => $this->mailData->customer_id,
            'customer_name' => $this->mailData->customer_name,
            'customer_login' => $this->mailData->customer_login,
            'url' => $this->mailData->url,
        ])->subject('Windx Telecomunicações - Notificação de redefinição de senha');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationErrosApp extends Notification implements ShouldQueue
{
    use Queueable;
    private $notification;
    private $mail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification, $mail)
    {
        $this->notification = $notification;
        $this->mail = $mail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage($this->notification))->to($this->mail);
//                    ->from('supwindx@gmail.com', 'Admin Central')
//                    ->line('Erro - Central Windx!')
//                    ->action('Entrar como admin', url('/'))
//                    ->subject('Invoice Payment Failed')
//                    ->line('Teste!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return json_encode($this->notification->toArray());
    }



}

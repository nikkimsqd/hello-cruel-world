<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentRequest extends Notification
{
    use Queueable;

    private $rent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rent)
    {
        $this->rent = $rent;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.') //startng body of the email
                    ->action('Notification Action', url('https://google.com')) //button name and its URL
                    ->line('Thank you for using our application!'); //closing paragraph of the email
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'text' => "You have a new rent request.",
            'rentID' => $this->rent['rentID'] //rentID ra ang ipass nga data para way hasol
        ];
    }
}

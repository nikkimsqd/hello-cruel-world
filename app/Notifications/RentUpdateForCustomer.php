<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentUpdateForCustomer extends Notification
{
    use Queueable;

    private $rentID;
    private $boutiqueName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rentID, $boutiqueName)
    {
        $this->rentID = $rentID;
        $this->boutiqueName = $boutiqueName;
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'text' => $this->boutiqueName.' has updated your rent. You can now proceed to process your payment.',
            'rentID' => $this->rentID
        ];
    }
}

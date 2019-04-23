<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCategoryRequest extends Notification
{
    use Queueable;

    private $gender;
    private $categoryName;
    private $boutiqueID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($gender, $categoryName, $boutiqueID)
    {
        $this->gender = $gender;
        $this->categoryName = $categoryName;
        $this->boutiqueID = $boutiqueID;
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
            'text' => "You have a new category request.",
            'gender' => $this->gender,
            'categoryName' => $this->categoryName,
            'boutiqueID' => $this->boutiqueID
        ];
    }
}

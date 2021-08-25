<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class commentnotify extends Notification
{
    use Queueable;
    private $cdetails;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cdetails)
    {
        $this->cdetails = $cdetails;
        //
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
        return (new MailMessage)
            ->greeting($this->cdetails['greetings'])
            ->line($this->cdetails['body'])
            ->line($this->cdetails['commented']);
    }
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'Name' => $this->cdetails['greetings'],
    //         'Comment' => $this->cdetails['body'],
    //         'Thanx' => $this->cdetails['commented']
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    { 
        return [
            'data'=>$this->cdetails['greetings'],
            'action'=>$this->cdetails['commented']
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class customDbNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return [customDbNotification::class,'broadcast'];
    }

    public function send($notifiable, Notification $notification)
  {
    $data = $notification->toDatabase($notifiable);

    // set custom message in another variable and unset it from default array.
    $msg = "hi";
    unset($data['message_text']);

    // lets create a DB row now with our custom field message text

    return $notifiable->routeNotificationFor('database')->create([

        'id' => $notification->id,
        'message_text' => $msg, //<-- comes from toDatabase() Method, this is my customised column
        'notifiable_type'=> \Auth::user()->id,
        'type' => get_class($notification),
        'data' => $data,
        'read_at' => null,
    ]);
  }


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
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
            //
        ];
    }
}

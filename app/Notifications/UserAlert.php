<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class UserAlert extends Notification
{
    use Queueable;
    public $title,$body,$url;
    /**
     * Create a new notification instance.
     */
    public function __construct($title,$body,$url)
    {
        $this->title=$title;
        $this->body=$body;
        $this->url=$url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon('/landing/img/logo.png')
            ->body($this->body)
            ->action('En savoir plus', 'open_url') // Identifiant d'action
            ->data(['url' => $this->url]);
            // ->data(['id' => $notification->id])
            // ->badge()
            // ->dir()
            // ->image()
            // ->lang()
            // ->renotify()
            // ->requireInteraction()
            // ->tag()
            // ->vibrate()
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

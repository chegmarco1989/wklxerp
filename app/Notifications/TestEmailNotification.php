<?php

namespace App\Notifications;

use App\Utils\NotificationUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestEmailNotification extends Notification
{
    use Queueable;

    protected $notificationInfo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationInfo)
    {
        $this->notificationInfo = $notificationInfo;
        $notificationUtil = new NotificationUtil();
        $notificationUtil->configureEmail($notificationInfo, false);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('This is a test email');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}

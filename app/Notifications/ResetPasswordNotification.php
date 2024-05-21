<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    // متغیر برای نگهداری توکن بازیابی رمز عبور
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('بازیابی رمز عبور')
            ->line('شما این ایمیل را دریافت کرده‌اید زیرا درخواست بازیابی رمز عبور برای حساب کاربری شما دریافت شده است.')
            ->action('بازیابی رمز عبور', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('اگر شما درخواست بازیابی رمز عبور نکرده‌اید، این ایمیل را نادیده بگیرید.');
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

<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailAddress extends Notification
{
    use Queueable;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new MailMessage;

        $mail->subject('Email Verification required')
            ->greeting('Hello, ' . $this->user->name)
            ->line('You have one more step remaining to activate your account. Click on the button below to verify your email address:')
            ->action('Verify Email', 'http://192.168.0.100:3000/account/activate/'.$this->user->activation_token)
            ->salutation('Best Regards, Sikizi IMS Team');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

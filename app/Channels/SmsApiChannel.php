<?php

namespace App\Channels;


use App\SmsMessage;
use Illuminate\Notifications\Notification;

class SmsApiChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        //get the message
        /** @var SmsMessage $message */
        $message = $notification->toSms($notifiable);
        //get the phone no
        $to = $notifiable->routeNotificationFor('smsapi');
        //send the sms
        resolve('\App\Http\Helpers\SmsHelper')->sendSms($message->getMessage(),[$to]);
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SmsMessage
 *
 * @mixin \Eloquent
 */
class SmsMessage extends Model
{
    protected $msg;

    //add a salutation to the message
    public function salutation($salutation)
    {
        if (is_string($salutation))
            $this->msg = $salutation . $this->msg;
        return $this;
    }

    //body of the sms text
    public function body($body)
    {
        if (is_string($body))
            $this->msg = $this->msg . ", " . $body;
        return $this;
    }

    //signing the message
    public function signature($signature)
    {
        if (is_string($signature))
            $this->msg = $this->msg . "\n" . $signature;
        return $this;
    }

    //get the msg
    public function getMessage()
    {
        return $this->msg;
    }


}

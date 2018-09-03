<?php

namespace App\Repository;


use App\Notifications\VerifyEmailAddress;
use App\User;
use App\Channel;
use Carbon\Carbon;
use Davidvandertuijn\Password;
use Webpatser\Uuid\Uuid;

class UserRepository
{
    public $user;
    public $errors;

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        #generate activation token
        $data['activation_token'] = Uuid::generate()->string;

        #validate the data
        $validation = $this->validate($data);

        if ($validation->passes()) {
            #hash password
            $data['password'] = bcrypt($data['password']);
            #create user
            $this->user = User::create($data);

            #send mail verify email address
            $this->user->notify(new VerifyEmailAddress($this->user));

            return true;
        }

        #set the errors variable
        $this->errors = $validation->errors();

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function activate($user)
    {
        #get the user with this activation token
        $this->user = $user;

        #do activate
        if ($this->user) {
            $this->user->activation_token = null;
            $this->user->activated_at = Carbon::now()->format('Y-m-d H:i:s');
            $this->user->save();
            return true;
        }

        return false;

    }

    /**
     * @param User $user
     */
    public function resend($user)
    {
        #new activation token
        $user->activation_token = Uuid::generate()->string;
        #update user
        $user->save();
        #send welcome email
        $user->notify(new VerifyEmailAddress($user));
    }

    public function inviteToDefaultChannels($org, $email){
        $repo = new ChannelRepository($org);

        $general = Channel::whereName('general')->first();
        if($general){
            $repo->inviteToChannel(['uuid'=>$general->uuid, 'email'=>$email]);
        }

        $random = Channel::whereName('random')->first();
        if($random){
            $repo->inviteToChannel(['uuid'=>$random->uuid, 'email'=>$email]);
        }
    }


    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    public function validate(array $data)
    {
        return \Validator::make($data, [
            "name" => "required|min:3",
            "email" => "required|email|unique:users,email|",
            "phone" => "required|between:10,14|unique:users,phone",
            "username" => "nullable|min:3|max:20|unique:users,username",
            "activation_token" => "required",
            "password" => "required",
        ]);
    }
}
<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'username', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token', 'activation_token', 'activated_at', 'pivot'
    ];

    /**
     * Find the user identified by the given $identifier.
     *
     * @param string $identifier emailOrPhoneOrUsername
     * @return mixed
     */
    public function findForPassport($identifier)
    {
        return User::query()->orWhere('email', $identifier)->orWhere('phone', $identifier)->orWhere('username', $identifier)->first();
    }


    //returns phone no, for sending sms notifications
    public function routeNotificationForSmsApi()
    {
        return $this->phone;
    }

}

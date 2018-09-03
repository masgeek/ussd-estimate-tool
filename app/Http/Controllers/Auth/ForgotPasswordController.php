<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordReset;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{

    /*
   |--------------------------------------------------------------------------
   | Forgot password Controller
   |--------------------------------------------------------------------------
   |
   | This controller is responsible for handling password reset emails and
   | includes a trait which assists in sending these notifications from
   | your application to your users.
   |
    */
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $validator = $this->doValidate($request->all());

        #if validation passes
        if ($validator->passes()) {

            $user = User::where('email', $request->all()['email'])->first();

            #create password reset token
            $token = $this->broker()->createToken($user);

            #send password reset email
            $user->notify(new PasswordReset($user, $token));

            return response(transformSuccess('An email with reset instructions has been sent to you'), 200);

        } else {
            #return validation errors
            return response(transformErrors('Invalid input',$validator->errors()), 422);

        }


    }

    public function doValidate(array $data)
    {
        return \Validator::make($data, [
            "email" => "required|email|exists:users,email|",
        ]);
    }

}

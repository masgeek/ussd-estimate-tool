<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{

    protected $userRepository;

    /**
     * EmailVerificationController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index($token)
    {
        #find a user based on the token
        $user = User::where('activation_token', $token)->first();

        #if user exists
        if ($user) {
            #update activation account details
            $this->userRepository->activate($user);

            return response(transformSuccess('Your email has been verified successfully.'),200);

        } else {

            return response(transformErrors('We are unable to verify your email address', ['token'=> ['The token provided is invalid']]),422);

        }
    }

    public function resendToken()
    {
        $this->userRepository->resend(\Auth::user());
        return response( transformSuccess('An email with verification instructions has been sent.'),200);
    }

}

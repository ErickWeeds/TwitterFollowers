<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
      return Socialite::driver('twitter')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
     public function handleProviderCallback()
     {
       $user = Socialite::driver('twitter')->user();
       session(['auth_token'=>$user->token]);
       session(['auth_token_secret'=>$user->tokenSecret]);
       $save_user["tw_id"] = $user->getId();
       $save_user["tw_nick"] = $user->getNickname();
       $save_user["tw_name"] = $user->getName();
       $save_user["tw_mail"]= $user->getEmail();
       $save_user["tw_img"] = $user->getAvatar();
       session(['tw_user'=>$save_user]);
       return redirect()->route('index');

    }
}

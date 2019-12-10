<?php

namespace App\Http\Controllers\Auth;

use App\User;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

    use AuthenticatesUsers{
        redirectPath as laravelRedirectPath;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectPath()
    {
        // Do your logic to flash data to session...
        session()->flash('message', 'your message');

        // Return the results of the method we are overriding that we aliased.
        return $this->laravelRedirectPath();
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //------------------------------------------------------------------------------
    /**
     * Method do authen
     *
     * @return true if exit and false if not exit
     */
    public function authen(Request $request) {
        $mesage = false;
        try {
            $password = $request->input('password');
            $email = $request->input('email');
            $credentials = array('email' => $email,
                'password' => $password
            );
            if (Auth::attempt($credentials)) {
                $mesage = true;
            }
        } catch (\Exception $e) {
            $mesage = false;
        }
        return response()->json(['MESSAGE' => $mesage]);
    }
}


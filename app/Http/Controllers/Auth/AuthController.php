<?php

namespace App\Http\Controllers\Auth;

use Config;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],

            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {


        Mail::send('auth.emails.welcome', ['name' => 'nnnnn'], function($message){
            $message->from('blklst.dev@gmail.com', 'TEST');
            $message->to('silaprod@gmail.com')->subject('TEST');
        });

        return "SEND";
//        dd(Config::get('mail'));
//
//        $this->validate($request, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
//            'password' => 'required|min:6|confirmed',
//        ]);
//
//        $confirmation_code = str_random(30);
//
//
//
//        User::create([
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'password' => bcrypt($request->input('password')),
//            'confirmation_code' => $confirmation_code
//        ]);
//
//        Mail::send('email.verify', $confirmation_code, function($message) {
//            $message->to(Input::get('email'), Input::get('username'))
//                ->subject('Verify your email address');
//        });




    }


}

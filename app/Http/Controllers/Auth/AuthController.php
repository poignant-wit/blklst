<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use Config;
use Auth;

use App\User;
use App\Social;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    private $register_rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
    ];

    private $login_rules = [
        'email' => 'required',
        'password' => 'required',
    ];


    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    /**
     * @param array $data
     * @param array $rules
     * @return mixed
     */
    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }


    /**
     * @param Request $request
     * @param $rules
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function validateRequest(Request $request, $rules)
    {
        $validator = $this->validator($request->all(), $rules);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
    }


    /**
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->validateRequest($request, $this->register_rules);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->confirmation_code = str_random(30);
        $user->save();

        if ($link = $request->input('linkedin_link')) {
            DB::table('linkedin_links')->insert([
                'user_id' => $user->id,
                'link' => $link,
            ]);
        }

        Mail::send('auth.emails.confirm', ['user' => $user], function ($message) use ($user) {
            $message->from('blklst.dev@gmail.com', 'Blclst service');
            $message->to($user->email)->subject('Welcome to Blklst service');
        });
        return redirect()->route('home')
            ->with('info', 'Проверьте почту'); //TODO MESSAGES PAGE

    }

    /**
     * @param $confirmation_code
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function confirmEmail($confirmation_code)
    {

        $user = User::where('confirmation_code', $confirmation_code)->first();

        if ($user) {
            $user->confirmed = 1;
            $user->confirmation_code = '';
            $user->save();
            $user->assign('recruiter');
            auth()->loginUsingid($user->id);

            return redirect()->route('home');
        }

        return view('welcome')
            ->with('info_danger', 'Ошибка верификации почты. Неверный код');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $this->validateRequest($request, $this->login_rules);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

            if (Auth::user()->hasRole('admin')) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }

            if (Auth::user()->confirmed == 0) {
                return view('welcome')
                    ->with('info_danger', 'Ваш аккаунт неактивирован, проверьте почту');
            }

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

//        if (Auth::attempt([
//            'email' => $request->input('email'),
//            'password' => $request->input('password'),
//            'confirmed' => 1
//        ])) {
//            return $this->handleUserWasAuthenticated($request, $throttles);
//        }

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        $user = Socialite::driver('linkedin')->user();

        $state = $request->get('state');
        $request->session()->put('state',$state);

        if(\Auth::check()==false){
            session()->regenerate();
        }

        $user_auth = null;
        $user_check = User::where('email', '=', $user->email)->first();

        if (!empty($user_check)) {
            $user_auth = $user_check;
        } else {
            $user_same_social_id = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider)->first();

            if (empty($user_same_social_id)) {
                $user_new = new User();
                $user_new->name = $user->name;;
                $user_new->email = $user->email;
                $user_new->confirmed = 1;
                $user_new->save();
                $user_new->assign('recruiter');

                $user_new_social = new Social();
                $user_new_social->social_id = $user->id;
                $user_new_social->provider = $provider;
                $user_new_social->user_id = $user_new->id;

                $user_new_social->save();

//                $role = Role::whereName('recruiter')->first();
//                $user_new->assign($role);
                $user_auth = $user_new;
            } else {
                $user_auth = $user_same_social_id->user;
            }
        }

        auth()->login($user_auth, true);
        return redirect()->route('home');
    }

}



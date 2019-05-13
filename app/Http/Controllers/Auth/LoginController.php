<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;

use Socialite;

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
    protected $redirectTo = '/';

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->scopes(['r_basicprofile', 'r_emailaddress'])->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if(!$user && $request->input('email')) {
            return back()->with('warning', 'User with entered email address not found.')->withInput();
        } elseif(!$user && $request->input('email') == null) {
            return back()->with('warning', 'Please provide a valid email address.')->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            if($request->input('password') == null && $request->input('email') == null) {
                return back()->with('warning', 'Please provide a valid email address and password.')->withInput();
            } elseif($request->input('password') == null) {
                return back()->with('warning', 'Please provide a valid password.')->withInput();
            } else {
                return back()->with('warning', 'The email and password do not match.')->withInput();
            }
        }

    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have previously sent you an activation code, please check your email.');
        }

        return redirect()->intended($this->redirectPath());
    }
  
    /**
     * Obtain the user information from Linkedin.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        if(User::where('email', $user->email)->first()) {
            $user = User::where('email', $user->email)->first();
            if($user->provider == null) {
                return redirect('/login')->with('warning', 'User is already registered with a password. Login via email and password instead.');
            }
        }

        dd("here");

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
  
    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'avatar'   => $user->avatar,
            'provider' => $provider,
            'provider_id' => $user->id,
            'verified' => 1
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    protected $username   = 'email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findLoginName();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findLoginName()
    {
        $loginName = request('loginName');

        $fieldType = filter_var($loginName, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $loginName]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handleProviderCallback($provider)
    {

        $userSocial = $this->getUserFromSocialite($provider);
        $localUser  = $this->getUserFromDatabase($userSocial, $provider);

        $localUser ? $this->loginUser($localUser) : $this->createUserThenLogin($userSocial, $provider);

        return redirect()->route('home');
    }


    /**
     * Get user using laravel socialite using a specific provider
     * @param $provider
     * @return mixed
     */
    protected function getUserFromSocialite($provider){
        return Socialite::driver($provider)->stateless()->user() ?: abort(501);
    }
    /**
     * Catch user from our database
     * @param $provider
     * @return mixed
     */
    protected function getUserFromDatabase($userSocial, $provider){
        return User::where(['email' =>$userSocial->getEmail(), 'provider' => $provider])->first();
    }

    /**
     * @param $user
     * @param $provider
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function createUserThenLogin($user, $provider){
        $user = User::create([
            'name'          => $user->getName(),
            'email'         => $user->getEmail(),
            'password'      => bcrypt(time() . uniqid()),
            'provider_id'   => $user->getId(),
            'provider'      => $provider,
        ]);

        $this->loginUser($user);
    }

    /**
     * @param $user
     */
    protected function loginUser($user){
        Auth::login($user);
    }
}

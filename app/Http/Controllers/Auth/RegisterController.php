<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Show the application registration form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['supportedCountry' => $this->isSupportedCountry()]);
    }

    /**
     * Handle a registration request for the application.
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function register(Request $request)
    {
        if(! $this->isSupportedCountry()){
            return response("Country not supported", 403);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $currentYear = date('Y');

        $allowYearFrom = $currentYear - 6; // minimum 6 years from now
        $allowYearTo   = $currentYear - 96; // maximum 90 years from now

        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:25'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender'   => ['required', 'string', 'in:male,female'],
            'yob'      => ['required', 'numeric', "min:{$allowYearTo}", "max:{$allowYearFrom}"]
        ], [], [
            'yob' => __('javascript.yob')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => ucfirst(\Str::camel($data['name'])),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $this->supportedCountries()->pluck('id', 'code2')[userCountry()['code']]
        ]);
    }
    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        session()->flash('success', __('site.registered_successfully', ['name' => $user->name]));

        return response(['redirectTo' => route('setFields')], 200);
    }

    /**
     * Check if the user country who wants to register is in our supported countries
     * @return bool
     * @throws \Exception
     */
    protected function isSupportedCountry(){
        return in_array(
            userCountry()['code'],
            $this->supportedCountries()->pluck('code2')->toArray()
        );
    }

    /**
     * Get all supported countries
     * @return mixed
     */
    protected function supportedCountries(){
        return resolve('Countries')->supported();
    }
}

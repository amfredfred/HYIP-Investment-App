<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use CountryState;
use App\Library\IPTranslate\GeoPlugin;
use Illuminate\Support\Facades\Session;
class RegisterController extends Controller {
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

    public function showRegistrationForm(Request $request) {
        $data['number'] = $this->setLocation($request);
        $data['countries'] = CountryState::getCountries();
        $ref = $request->ref;
        //save the ref whenever user registered we captioned it 
        $user_ref = Session::get('ref');
        if (!empty($ref)) {
            $data['ref'] = $request->ref;
            session(['ref' => $ref]);
        } elseif (!empty($user_ref)) {
            $data['ref'] = $user_ref;
        } else {
            $data['ref'] = null;
        }
        return view('auth.register', $data);
    }

    private function setLocation(Request $request) {
        $ip = $request->getClientIp();
        $geoip = GeoPlugin::locate($ip);
        $code = $geoip->getCountryCode();
        if (!empty($code)) {
            $code_list = \megastruktur\PhoneCountryCodes::getCodesList();
            $phone_code = collect($code_list[$code]);
            return $phone_code[0];
        }
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
        ]);
    }

}

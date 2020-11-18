<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\ValidateSecretRequest;
use Illuminate\Support\Facades\Session;
use Crypt;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {
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

    private $user;

    use AuthenticatesUsers;

    protected function authenticated(Request $request, Authenticatable $user) {
        if ($user->google2fa_secret_status == true) {
            Auth::logout();
            $request->session()->put('2fa:user:id', $user->id);
            return redirect('2fa/validate');
        }

        return redirect()->intended($this->redirectTo);
    }

    public function getValidateToken() {

        if (session('2fa:user:id')) {
            return view('2fa/validate');
        }

        return redirect('login');
    }

    public function postValidateToken(Request $request) {
        $this->validate($request, [
            'totp' => 'required|numeric'
        ]);
        $userId = Session::get('2fa:user:id');
        $user = \App\User::whereId($userId)->first();
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $request->totp;
        $user_secret = Crypt::decrypt($user->google2fa_secret);

        $timestamp = $google2fa->verifyKeyNewer($user_secret, $secret, $user->google2fa_ts);

        if ($timestamp !== false) {
            $user->update(['google2fa_ts' => $timestamp]);
            //login and redirect user
            Auth::loginUsingId($userId);
            Session::forget('2fa:user:id');
            return redirect()->intended($this->redirectTo);
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid code was entered');
            return Redirect::back();
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

}

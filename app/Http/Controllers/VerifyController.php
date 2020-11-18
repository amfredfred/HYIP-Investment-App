<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Traits\HasError;
use Illuminate\Http\Request;
use App\User;

class VerifyController extends Controller {

    use HasError;

    public function __construct() {
        $this->middleware('auth');
    }

    public function verify() {
        return view('auth.verify');
    }

    public function verifyPost(Request $request) {
        $input = $request->all();
        $rules = ([
            'code' => 'required|numeric'
        ]);


        $error = static::getErrorMessageSweet($input, $rules);

        if ($error) {
            return $error;
        }
        $code = User::whereVerified_code($request->code)->first();
        if (is_object($code)) {
            $code->code = true;
            $code->save();
            return redirect('/dashboard');
        } else {
            session()->flash('message.level', 'error');
            session()->flash('message.color', 'red');
            session()->flash('message.content', 'Invalid Verification Code');
            return redirect()->back();
        }
    }

}

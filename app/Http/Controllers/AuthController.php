<?php

namespace App\Http\Controllers;


class AuthController extends Controller
{
   
    public function getValidateToken()
    {

        if (session('2fa:user:id')) {
            return view('2fa/validate');
        }

        return redirect('login');
    }
   
}

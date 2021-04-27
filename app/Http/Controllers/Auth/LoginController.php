<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (Auth::user()->is_actived == 1) {
            if (Auth::user()->role_id == 1) {
                return RouteServiceProvider::ADMIN;
            } else if (Auth::user()->role_id == 2) {
                return RouteServiceProvider::RECEPT;
            } else if (Auth::user()->role_id == 3) {
                return RouteServiceProvider::DOCTOR;
            } else if (Auth::user()->role_id == 4) {
                return RouteServiceProvider::PHARMA;
            } else if (Auth::user()->role_id == 5) {
                return RouteServiceProvider::CHASIER;
            } else if (Auth::user()->role_id == 6) {
                return RouteServiceProvider::LOG;
            }
        }
        return RouteServiceProvider::HOME;
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
}

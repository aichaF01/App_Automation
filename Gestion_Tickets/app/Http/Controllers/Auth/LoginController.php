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
        if (Auth::check()) {
            $userType = Auth::user()->type_user;

            if ($userType === 'admin') {
                return RouteServiceProvider::INDEX; // Rediriger l'admin vers la page des tickets
            } else {
                return RouteServiceProvider::HOME; // Rediriger l'utilisateur vers la page de création de ticket
            }
        }

        return RouteServiceProvider::HOME; // Par défaut, rediriger vers la page d'accueil
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

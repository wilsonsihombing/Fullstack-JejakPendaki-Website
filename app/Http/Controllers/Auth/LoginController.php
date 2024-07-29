<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    /**
     * Redirect the user after login.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Auth\User $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($request, $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('dashboard'); // Redirect to admin dashboard
        }

        return redirect()->route('home'); // Redirect to home for regular users
    }
}

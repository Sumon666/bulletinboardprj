<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance for login.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }
        if (Auth::attempt(['email' => $email, 'password' => $password, 'type' => 0])) {
            return redirect('postlist')
                ->with('success', 'login success');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'type' => 1])) {
            return redirect('postlist')
                ->with('success', 'login success');
        } else {
            return redirect()->intended('login')
                ->with('loginError', 'Email or password is incorrect');
        }
    }
}

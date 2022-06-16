<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

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

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->only('email', 'password');

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                session(['wordCount' => $data['password']]);
                return redirect('/top');
            } else {
                session(['error' => '該当するメールアドレスが存在しないか、パスワードが正しくありません']);
                return redirect('/login');
            }
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('wordCount');
        return redirect('/login');
    }
}

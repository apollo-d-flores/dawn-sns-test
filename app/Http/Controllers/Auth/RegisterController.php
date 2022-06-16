<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/home';

    protected $validateRules = [
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100|email|unique:users',
        'password' => 'required|alpha_dash|min:6|max:50',
        'password-confirm' => 'required|alpha_dash|min:6|max:50|same:password'
    ];

    protected $validateMessages = [
        'name.required' => '名前は必ず入力してください',
        'name.max' => '入力の上限を超えています',
        'email.required' => 'メールアドレスは必ず入力してください',
        'email.email' => 'メールアドレスの形式ではございません',
        'email.max' => '入力の上限を超えています',
        'email.unique' => 'すでに利用されているメールアドレスです',
        'password.required' => 'パスワードは必ず入力してください',
        'password.alpha_dash' => 'パスワードは英数字でのみ入力できます',
        'password.min' => '入力の下限を超えています',
        'password.max' => '入力の上限を超えています',
        'password-confirm.required' => 'パスワード確認は必ず入力してください',
        'password-confirm.alpha_dash' => 'パスワード確認は英数字でのみ入力できます',
        'password-confirm.min' => '入力の下限を超えています',
        'password-confirm.max' => '入力の上限を超えています',
        'password-confirm.same' => 'パスワードの入力が不一致です'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateRule()
    {
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return \DB::table('users')
            ->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $val = Validator::make(
                $data,
                $this->validateRules,
                $this->validateMessages
            );
            if ($val->fails()) {
                return redirect('/register')->withErrors($val)->withInput();
            } else {
                $this->create($data);
                return redirect('/added')->with('name', $data['name']);
            }
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}

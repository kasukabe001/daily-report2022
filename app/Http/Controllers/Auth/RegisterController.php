<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'affiliation' => ['max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //管理者登録用隠しコマンド
        if ($data['affiliation']=='管理者') {
            $value=1;
            $this->redirectTo = '/admin'; // 管理者ページにlogin
        } else {
            $value=0;
        }

        $maildata = [
                'name' => $data['name'],
                'affiliation' =>  $data['affiliation'],
            ];
        // メール送信
        $email="transfer02@gairai.sakura.ne.jp";
        
        // herokuでは送信できない
        Mail::send(new TestMail($maildata, $email));
        // データ登録
         return User::create([
                'name' => $data['name'],
                'affiliation' => $data['affiliation'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'admin_flg' => $value,
        ]);
    }
}

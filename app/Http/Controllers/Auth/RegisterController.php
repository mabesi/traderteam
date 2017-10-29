<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|min:5|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|not_in:password,12345678,123456789,1234567890,87654321,987654321,0987654321,76543210,abcd1234,1234abcd,qwertyuiop,asdfghjk,abcdefgh|confirmed',
            'terms' => 'required',
            'captcha' => 'required|captcha',
        ],[
          'captcha.captcha' => 'Validação do captcha incorreta!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => special_ucwords($data['name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $profile = Profile::create([
          'user_id' => $user->id,
        ]);

        $user->locked = True;
        $user->save();

        //if (env('APP_ENV')=='production' || env('APP_ENV')=='local' ){
        //}
        sendConfirmationEmail($user);

        return $user;
    }
}

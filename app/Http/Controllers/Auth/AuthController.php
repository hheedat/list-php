<?php

namespace App\Http\Controllers\Auth;

use App\User;
//use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/list/check';

    protected $loginPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

//    public function aauthenticate($email, $password, $remember)
//    {
//        \Log::error("aaa aaa");
//
//        return Response()->json(['apple' => 'watch']);
//
//        \Log::error("aaa bbb");
//
////        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
////
////            //return redirect($this->redirectPath);
////
////            return Response()->json(['apple' => 'watch']);
////
////        }
//    }
//
//    public function getLogin()
//    {
//
//
//    }
//
//    public function postLogin(Request $request)
//    {
//
//        return Response()->json(['apple' => 'watch']);
//
//        $this->aauthenticate($request->input('email'), $request->input('password'), $request->input('remember'));
//
//    }
//
//
//    public function getLogout()
//    {
//        Auth::logout();
//    }
}

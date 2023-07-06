<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function goLogin(Request $request){

        // dd($request);

        if(Auth::attempt(['name' => $request->username, 'password' => $request->password]))
        {

            

            return redirect()->intended('home');
        } else {
            // return redirect()->intended('login')->withErrors(['msg' => 'Username and password not match']);
            return redirect()->back()->with('error', 'Username and password not match');   
        }

    }

    public function testGetData(Request $request){



    }

    

}

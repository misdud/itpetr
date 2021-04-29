<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * AuthenticatesUsers=> public function username()  {   return 'login';  }
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
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


    // castom
    /*public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
*/


    //!!!!!!!!!!! SHOW AuthenticatesUsers
    
    //public function showLoginForm(){    //show top menu?
     //$showTopMenu = true;
 
     //$isShowSidebarClass = true;
    // $isShowFooter = false;
     //---for--view
    // $title ='Вход на сайт';
    // $activePage ='login';
     //$navName ='login';

        //dd('test');
       // $pass = Hash::make('703');
        //echo $pass;

       // return view('auth.login', compact('showTopMenu', 'isShowSidebarClass', 'isShowFooter', 'title', 'activePage', 'navName'));
    //}




}

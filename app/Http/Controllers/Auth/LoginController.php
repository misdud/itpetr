<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;

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

    public function showLoginForm(){    //show top menu?
     $showTopMenu = true;
 
     $isShowSidebarClass = true;
     $isShowFooter = false;
     //---for--view
     $title ='Вход на сайт';
     $activePage ='login';
     $navName ='login';

        //dd('test');
        $pass = Hash::make('703');
        //echo $pass;

        return view('auth.login', compact('showTopMenu', 'isShowSidebarClass', 'isShowFooter', 'title', 'activePage', 'navName'));
    }



}

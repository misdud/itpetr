<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$showTopMenu = true;
        if (View::exists('welcome')) {
            return view('welcome',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
         }
         abort('404');

        //return redirect()->route('welcome');
    }
}

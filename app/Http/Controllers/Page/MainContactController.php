<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

class MainContactController extends Controller
{
    public function index(){

        if (View::exists('pages.contacts')) {
            
            return view('pages.contacts');

        }

    }







}

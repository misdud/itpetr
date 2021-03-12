<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MainManagerController extends Controller
{
    public function index()
    {

        if (View::exists('pages.managers')) {
            return view('pages.managers');
        }
    }
}

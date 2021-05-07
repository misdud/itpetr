<?php

namespace App\Http\Controllers\Сontact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function showAllContactPDF(){
        //$showTopMenu = true;
        if (View::exists('contacts.all_contact')) {
            return view('contacts.all_contact',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
         }
         abort('404');
    }
}

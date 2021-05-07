<?php

namespace App\Http\Controllers\Autobus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BusScheduleController extends Controller
{
    public function busschedule1(){
                //$showTopMenu = true;
                if (View::exists('busschedule.busschedule_1')) {
                    return view('busschedule.busschedule_1',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
                 }
                 abort('404');
    }

    public function busschedule2()
    {
                //$showTopMenu = true;
                if (View::exists('busschedule.busschedule_2')) {
                    return view('busschedule.busschedule_2',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
                }
                abort('404');
    }

    public function busschedule3()
    {
                //$showTopMenu = true;
                if (View::exists('busschedule.busschedule_3')) {
                    return view('busschedule.busschedule_3',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
                }
                abort('404');
    }

    public function busschedule4()
    {
                //$showTopMenu = true;
                if (View::exists('busschedule.busschedule_4')) {
                    return view('busschedule.busschedule_4',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
                }
                abort('404');
    }
}

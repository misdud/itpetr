<?php

namespace App\Http\Controllers\Schema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MainControllerSchema extends Controller
{
    public function index(){

    }

    public function mainSchema(){
        
        //get url of constants
        $urlScemaPetricovMain=config('constants.options.shema_webip22_petr_main');

        //show top menu?
        $showTopMenu = false;
        //show top menu?
        $isShowSidebarClass = false;
        $isShowFooter = false;

        return view('schems.petrikov_main', compact('urlScemaPetricovMain', 'showTopMenu',
            'isShowSidebarClass', 'isShowFooter'));

        if (View::exists('schems.petrikov_main')) {
            return view('schems.petrikov_main', compact('urlScemaPetricovMain', 'showTopMenu',
            'isShowSidebarClass', 'isShowFooter'));
        }
        abort("404");

    }

    public function mainSchemaParams(){
        
        //get url of constants
        $urlScemaPetricovMain=config('constants.options.shema_webip22_petr_main_params');

        //show top menu?
        $showTopMenu = false;
        $isShowSidebarClass = true;
        $isShowFooter = false;

        if (View::exists('schems.petrikov_main_param')) {
            return view('schems.petrikov_main_param', compact('urlScemaPetricovMain', 'showTopMenu',
            'isShowSidebarClass', 'isShowFooter'));
        }
        abort("404");

    }

    
    public function mainRaportSof(){
        
        //get url of constants
        $urlRaportPetricovMain=config('constants.options.raport_webip22_main_sof');

        //show top menu?
        $showTopMenu = false;
        $isShowSidebarClass = false;
        $isShowFooter = false;

        if (View::exists('schems.raport_main_sof')) {
            return view('schems.raport_main_sof', compact('urlRaportPetricovMain', 'showTopMenu',
                   'isShowSidebarClass', 'isShowFooter'));
        }
        abort("404");

    }

    public function mainRaportRu(){
        
        //get url of constants
        $urlRaportPetricovMain=config('constants.options.raport_webip22_main_rudnik');

        //show top menu?
        $showTopMenu = false;
        $isShowSidebarClass = false;
        $isShowFooter = false;

        if (View::exists('schems.raport_main_ru')) {
            return view('schems.raport_main_ru', compact('urlRaportPetricovMain', 'showTopMenu',
                   'isShowSidebarClass', 'isShowFooter'));
        }
        abort("404");

    }
    

}

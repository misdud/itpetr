<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\User;
use App\Models\Department;
use App\Models\Subdepartmen;
use App\Models\Position;
use App\Models\Role;

class MainManagerListController extends Controller
{
    public function showRudoupravlenie()
    {

        $depart = Department::select(  //with('author:id,name')
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'рудоуправл'.'%')->first();

         $botton = 'rudoupr';

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
     
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }
    }

    public function showRudnik(){

        $depart = Department::select( 
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'рудник'.'%')->first();

         $botton = 'rudnik';

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
     
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }

    }

    
    public function showSof(){

        $depart = Department::select( 
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'соф'.'%')->first();

         $botton = 'sof';

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
     
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }

    }

    public function showTes(){

        $depart = Department::select( 
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'тэс'.'%')->first();

         $botton = 'tes'; 

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
     
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }

    }

    public function showVspomogat(){ 

        $depart = Department::select( 
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'вспомогат'.'%')->first();

         $botton = 'vspomogat';

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
     
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }

    }

    public function showManagerSearch(Request $request){ 

        $data = $request->only('search');

        if(empty($data['search'])){
            return $this->showRudoupravlenie();
        }else{
            $userManagers = User::select(
                                        'id',
                                        'depart_id',
                                        'subdepart_id',
                                        'position_id',
                                        'fio_full',
                                        'show_manager',
                                        'login',
                                        'tel_belki',
                                        'tel_mob',
                                        'activ',
                                        'itr',
                                        'created_at'
            )
            ->where('show_manager', 1) 
            ->where('activ', 1)
            ->where('fio_full', 'LIKE', '%'.$data['search'].'%')
            ->orderBy('prioritet')->get();
        }

        $botton = '';
        $depart = '';

       /* $depart = Department::select( 
            'id',
            'name_depart',
            'priori',
         )->where('name_depart', 'LIKE', '%'.'вспомогат'.'%')->first();

         $botton = '';

         $userManagers= $depart->users()
         ->where('show_manager', 1) 
         ->where('activ', 1)->orderBy('prioritet')->get();
      */
        if (View::exists('list_managers.managers_show_list')) {
            return view('list_managers.managers_show_list', compact('userManagers', 'depart', 'botton'));
        }

    }
}

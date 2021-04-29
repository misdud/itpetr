<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Config;

use App\Models\ProjectWinCC;
use App\Models\ProjectTIA;
use App\Models\Department;
use App\Models\User;
use Gate;

class MainManagerController extends Controller
{
    public function index()
    {
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }

         $departs = Department::select('id', 'name_depart', 'priori', 'created_at', 'updated_at')->orderBy('priori')->paginate(10);
         $departsCount = Department::count();

        //$data1=$data->paginate(15);

        if (View::exists('pages.manager.list_depart_catalogs')) {

            return view('pages.manager.list_depart_catalogs', compact('departs', 'departsCount'));
        }
        return redirect()->to('404');
    }

    public function indexWinCCTia()
    {
       
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }
       
        $projects = ProjectWinCC::select(
            'id',
            'name_project',
            'create_project',
            'name_otdelenie',
            'name_controller',
            'map_project',
            'tel_project',
            'info_project',
            'updated_at'
        )->orderBy('name_otdelenie')->paginate(10);
        $projectCount = ProjectWinCC::count();
        //dd( $projects);
        

        if (View::exists('pages.manager.61_list_project_catalogs')) {

            return view('pages.manager.61_list_project_catalogs', compact('projects', 'projectCount'));
        } else {

            return redirect()->to('404');
        }
    }
}

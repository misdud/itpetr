<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\Department;

class MainManagerController extends Controller
{
    public function index()
    {


         $departs = Department::select('id', 'name_depart', 'priori', 'created_at', 'updated_at')->orderBy('priori')->paginate(10);
         $departsCount = Department::count();

        //$data1=$data->paginate(15);

        //dd($departs);


        if (View::exists('pages.manager.list_depart_catalogs')) {

            return view('pages.manager.list_depart_catalogs', compact('departs', 'departsCount'));
        }
        return redirect()->to('/404');
    }
}

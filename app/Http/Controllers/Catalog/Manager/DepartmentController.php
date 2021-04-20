<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

//use App\Http\Requests\StoreDepartment;
use App\Models\Department;

class DepartmentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pluck->collection
        $idDepartment = Department::pluck('id'); 
        

        $priori_dep=1;

        if(! $idDepartment->isEmpty()){
            $sort=$idDepartment->sortBy('id');
            $maxValue = max($sort->toArray());
            $priori_dep = $maxValue + 1;
        }   
    
        if(View::exists('pages.manager.form_create_departm')){
             return view('pages.manager.form_create_departm', ['priori'=>$priori_dep ]);
        }
        abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // ---для проверки доступа
           //isAdmin
           // if(Gate::denies('show_users_admin')){
           //     return redirect()->route('no_access');
            //}

            if ($request->isMethod('POST')) {

                $data = $request->only(['name', 'numPriori']);


                $rules = [
                    'name' => ['unique:App\Models\Department,name_depart', 'required', 'alpha', 'max:99'],
                    'numPriori' => ['required','numeric']
                ];

                $this->validate($request, $rules);

                Department::create([
                    'name_depart' => $data['name'],
                    'priori' => $data['numPriori'],
               ]);


                $message = "Отдел -| ". $data['name']  ." |- успешно создан.";
                return redirect()->back()->with('message', $message);
            } else {
                $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
                return redirect()->back()->with('message', $message);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {

        $dataDepart = Department::findOrFail($id);

        //dd($data);
        if(View::exists('pages.manager.form_edit_departm')){
            return view('pages.manager.form_edit_departm', compact('dataDepart'));
       }
       abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if($request->isMethod('PUT')){

            $data = $request->only(['name', 'numPriori']);

            $rules = [
                'name' => ['unique:App\Models\Department,name_depart', 'required',  'max:99'],
                'numPriori' => ['required','numeric']
            ];

            $this->validate($request, $rules);

            $dataModel = Department::findOrFail($id);

            $dataModel->name_depart =  $data['name'];
    
            $dataModel->save();

            $message = "Наименование отдела успешно изменёно.";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }
}

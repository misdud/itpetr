<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\Department;
use App\Models\Subdepartmen;

use Illuminate\Support\Arr;



class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idDepart = 0; //for all
        $subdeparts = Subdepartmen::with('department')->select('id', 'depart_id', 'name_subdepart', 'priori_sub', 'created_at', 'updated_at')->orderBy('name_subdepart')->paginate(10);
        $subdepartsCount = Subdepartmen::count();
        
        //---for select---
        $departs = Department::select('id', 'name_depart', 'priori')->orderBY('priori')->get();

        if (View::exists('pages.manager.21_list_subdepart_catalogs')) {

            return view('pages.manager.21_list_subdepart_catalogs', compact('subdeparts', 'subdepartsCount', 'departs', 'idDepart'));
        } else {

            return redirect()->to('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pluck->collection
        $idsubDepartment = Subdepartmen::pluck('id');

        $depart = Department::select('id', 'name_depart', 'priori')->orderBY('priori')->get();

        $countSubDepart = Department::count();


        $priori_subdep = 1;

        if (!$idsubDepartment->isEmpty()) {
            $sort = $idsubDepartment->sortBy('id');
            $maxValue = max($sort->toArray());
            $priori_subdep = $maxValue + 1;
        }

        if (View::exists('pages.manager.22_form_create_subdepartm')) {
            return view('pages.manager.22_form_create_subdepartm', ['priori_subdep' => $priori_subdep,
                                                                    'countDepart'=>$countSubDepart, 
                                                                    'departs'=>$depart]);
        } else {
            abort('404');
        }
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

                $data = $request->only(['selectDepart', 'name', 'numPriori']);
                
              

                $rules = [
                    'name' => ['unique:App\Models\Subdepartmen,name_subdepart', 'required',  'max:110'],
                    'numPriori' => ['unique:App\Models\Subdepartmen,priori_sub','required','numeric'],
                ];
 
                $this->validate($request, $rules);

                $departm = Department::findOrFail($data['selectDepart']);

                $subdepart = new Subdepartmen(
                    [
                    'name_subdepart' => $data['name'],
                    'priori_sub' => $data['numPriori'],
                    ]
                );
 
                $subdepart->department()->associate($departm);
                $subdepart->save();
                

                $message = "Подразделение -| ". $data['name']  ." |- успешно создано.";
                return redirect()->back()->with('message', $message);
            } else {
                $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
                return redirect()->back()->with('message', $message);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataSubDepart = Subdepartmen::findOrFail($id);
        $departs = Department::select('id', 'name_depart', 'priori')->orderBY('priori')->get();

        if(View::exists('pages.manager.23_form_edit_subdepartm')){
            return view('pages.manager.23_form_edit_subdepartm', compact('dataSubDepart', 'departs'));
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

            $data = $request->only(['selectDepart', 'name', 'numPriori', 'oldDepart']);

            $rules = [
                'name' => ['required',  'max:110'],
                'numPriori' => ['required','numeric'],
            ];

            $this->validate($request, $rules);
            
            $dataOldDepart = Department::findOrFail($data['oldDepart']);
            $dataDepart = Department::findOrFail($data['selectDepart']);
            $dataSubDepart = Subdepartmen::findOrFail($id);

            //dd( $data,  $dataDepart->id, (int)$data['selectDepart']);

            if(($dataOldDepart->id == (int)$data['selectDepart']) && ($dataSubDepart->name_subdepart == $data['name']) && ($dataSubDepart->priori_sub == (int)$data['numPriori'])){
                $message = "Данные идентичны с текущими значениями.";
                return redirect()->back()->with('msgIdentical', $message);
            }

            $dataSubDepart->department()->associate($dataDepart);
            $dataSubDepart->name_subdepart =  $data['name'];
            $dataSubDepart->priori_sub =  $data['numPriori'];
    
            $dataSubDepart->save();

            $message = "Данные по подразделению успешно изменёны.";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при изменении записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selectDepart(Request $request)
    {

        if (($request->has('selectDepart'))) {
    
            $idInput = $request->only('selectDepart');
            $id['selectDepart'] = $idInput['selectDepart'];

            // -------------add data in session
            session()->put(['selectDepart'=>$request->only('selectDepart')]);
            

            if (($id['selectDepart'] == 0)) {
                $subdeparts = Subdepartmen::with('department')->select('id', 'depart_id', 'name_subdepart', 'priori_sub', 'created_at', 'updated_at')->orderBy('priori_sub')->paginate(10);
                $subdepartsCount = Subdepartmen::count();
                $idDepart = $id['selectDepart'];
            } else {
                $subdeparts = Subdepartmen::with('department')->select('id', 'depart_id', 'name_subdepart', 'priori_sub', 'created_at', 'updated_at')->where('depart_id', $id['selectDepart'])->orderBy('priori_sub')->paginate(10);
                $subdepartsCount = Subdepartmen::where('depart_id', $id['selectDepart'])->count();
                $idDepart = $id['selectDepart'];
            }
        } else {
                 
                //------------get data from session
                $id = $request->session()->get('selectDepart');
                //dd($id);

            if (($id['selectDepart'] == 0 )) {
                $subdeparts = Subdepartmen::with('department')->select('id', 'depart_id', 'name_subdepart', 'priori_sub', 'created_at', 'updated_at')->orderBy('priori_sub')->paginate(10);
                $subdepartsCount = Subdepartmen::count();
                $idDepart = $id['selectDepart'];

            } else {
                $subdeparts = Subdepartmen::with('department')->select('id', 'depart_id', 'name_subdepart', 'priori_sub', 'created_at', 'updated_at')->where('depart_id', $id['selectDepart'])->orderBy('priori_sub')->paginate(10);
                $subdepartsCount = Subdepartmen::where('depart_id', $id['selectDepart'])->count();
                $idDepart = $id['selectDepart'];
            }  

        }
        
        $departs = Department::select('id', 'name_depart', 'priori')->orderBY('priori')->get();

        if (View::exists('pages.manager.21_list_subdepart_catalogs')) {

            return view('pages.manager.21_list_subdepart_catalogs', compact('subdeparts', 'subdepartsCount', 'departs', 'idDepart'));
        } else {

            return redirect()->to('404');
        }
    }

}

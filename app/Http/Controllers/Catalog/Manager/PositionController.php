<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\Position;
use Gate;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }
      
        $positions = Position::select('id', 'name_position',  'created_at', 'updated_at')->orderBy('name_position')->paginate(10);
        $departsCount = Position::count(); 

        if (View::exists('pages.manager.31_list_position_catalogs')) {

            return view('pages.manager.31_list_position_catalogs', compact('positions', 'departsCount'));
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

        if (View::exists('pages.manager.32_form_create_position')) {
                return view('pages.manager.32_form_create_position');
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
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }
          
            if ($request->isMethod('POST')) {

                $data = $request->only([ 'name']);

                $rules = [
                    'name' => ['unique:App\Models\Position,name_position', 'required',  'max:50'],
                ];
 
                $this->validate($request, $rules);

               Position::create([
                    'name_position' => $data['name'],
               ]);
                
                $message = "Должность -| ". $data['name']  ." |- успешно создана.";
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
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataPosition = Position::findOrFail($id);
        //dd($dataPosition);

        if(View::exists('pages.manager.33_form_edit_position')){
            return view('pages.manager.33_form_edit_position', compact('dataPosition'));
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
    public function update(Request $request, $id=false)
    {
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }

        if($request->isMethod('PUT')){

            $data = $request->only(['name']);

            $rules = [
                'name' => ['unique:App\Models\Position,name_position', 'required',  'max:50'],
            ];

            $this->validate($request, $rules);

            $dataModel = Position::findOrFail($id);

            $dataModel->name_position =  $data['name'];
    
            $dataModel->save();

            $message = "Наименование должности успешно изменёно.";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

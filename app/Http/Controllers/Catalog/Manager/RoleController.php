<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::select('id', 'role_name', 'role_info', 'created_at', 'updated_at')->orderBy('id')->paginate(10);
        $rolesCount = Role::count();


        if (View::exists('pages.manager.41_list_role_catalogs')) {

            return view('pages.manager.41_list_role_catalogs', compact('roles', 'rolesCount'));
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
        if (View::exists('pages.manager.42_form_create_role')) {
            return view('pages.manager.42_form_create_role');
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

            $data = $request->only(['name', 'infoRole']);

            $rules = [
                'name' => ['unique:App\Models\Role,role_name', 'required',  'max:13'],
                'infoRole' => ['required',  'max:99'],

            ];

            $this->validate($request, $rules);

            $arrCan = ['admin', 'manager_main', 'manager',  'master', 'operator'];


            if (in_array($data['name'], $arrCan)) {
               
                Role::create([
                    'role_name' => $data['name'],
                    'role_info' => $data['infoRole'],
                ]);

                $message = "Роль -| " . $data['name']  . " |- успешно создана.";
                return redirect()->back()->with('message', $message);
            } else {
                $message = 'Пока нет необходимости в создании такой роли или обратитесь к администратору.';
                return redirect()->back()->with('message', $message);
            }

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
        $dataRole = Role::findOrFail($id);

        //dd($data);
        if(View::exists('pages.manager.43_form_edit_role')){
            return view('pages.manager.43_form_edit_role', compact('dataRole'));
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

            $data = $request->only(['roleInfo']);

            $rules = [
                'roleInfo' => ['required',  'max:99'],
            ];

            $this->validate($request, $rules);

            $dataModel = Role::findOrFail($id);

            $dataModel->role_info =  $data['roleInfo'];
    
            $dataModel->save();

            $message = "Описание роли  успешно изменёно.";
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
    public function destroy($id)
    {
        //
    }
}

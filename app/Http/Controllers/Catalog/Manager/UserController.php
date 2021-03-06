<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Department;
use App\Models\Subdepartmen;
use App\Models\Position;
use App\Models\Role;

use Gate;


class UserController extends Controller
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
        
        
        $users = User::with('department', 'subdepartment', 'position')->select(
            'id',
            'depart_id',
            'subdepart_id',
            'position_id',
            'fio_full',
            'show_manager',
            'prioritet',
            'login',
            'tel_belki',
            'tel_mob',
            'activ',
            'itr',
            'created_at')->orderBy('fio_full')->orderBy('prioritet')->paginate(15);
        $userCount = User::count();

        if (View::exists('pages.manager.51_list_user_catalogs')) {

            return view('pages.manager.51_list_user_catalogs', compact('users', 'userCount'));
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

        $depart = Department::select('id', 'name_depart')->orderBY('id')->get();

        if (View::exists('pages.manager.52_form_create_user')) {
            return view('pages.manager.52_form_create_user', ['departs' => $depart]);
        } else {
            abort('404');
        }
    }


    /**
     * select--depart---for--user--create. (form - 1)
     *
     * @param  int  $id - depart
     * @return \Illuminate\Http\Response
     */
    public function userDeprt(Request $request)
    {
        // ---для проверки доступа
        //isAdmin
        // if(Gate::denies('show_users_admin')){
        //     return redirect()->route('no_access');
        //}

        if ($request->isMethod('GET')) {

            $data = $request->only(['selectDepart', 'name', 'login']);

            $rules = [
                'name' => ['unique:App\Models\User,fio_full', 'required',  'max:60'],
                'login' => ['unique:App\Models\User,login', 'required', 'numeric'],
            ];

            $this->validate($request, $rules);

            $sudepartmens = Subdepartmen::select('id', 'name_subdepart')->where('depart_id', '=', $data['selectDepart'])->orderBY('id')->get();
            $positions = Position::select('id', 'name_position')->orderBY('id')->get();
            $depart = Department::select('id', 'name_depart')->where('id', '=', $data['selectDepart'])->get();
            $depart = Department::findOrFail($data['selectDepart']);


            if (View::exists('pages.manager.522_form_create_user')) {
                return view('pages.manager.522_form_create_user', [
                    'nameFio' => $data['name'],
                    'login' => $data['login'],
                    'depart' => $depart,
                    'subdeparts' => $sudepartmens,
                    'positions' => $positions
                ]);
            } else {
                abort('404');
            }
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
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

            $data = $request->only([
                'name', 'login', 'departId', 'selectSubDepart', 'selectPosition',
                'activ', 'itr', 'show_manager',
                'tel_belki', 'tel_mob', 'room',
                'dr', 'prioritet', 'pasword',
            ]);

            $rules = [
                /*'name' => ['unique:App\Models\User,fio_full', 'required',  'max:60'],
                      'login' => ['unique:App\Models\User,login', 'required'], --- ранее проверяем в userDeprt()*/
                'pasword' => ['required',  'min:6'],

            ];

            $this->validate($request, $rules);

            $depart = Department::findOrFail($data['departId']);
            $subDepart = Subdepartmen::findOrFail($data['selectSubDepart']);
            $position = Position::findOrFail($data['selectPosition']);

            if (!empty($request->input('tel_belki'))) {
                $tel_belki = $data['tel_belki'];
            } else {
                $tel_belki = 'н\д';
            }

            if (!empty($request->input('tel_mob'))) {
                $tel_mob = $data['tel_mob'];
            } else {
                $tel_mob = 'н\д';
            }

            if (!empty($request->input('room'))) {
                $room = $data['room'];
            } else {
                $room = 'н\д';
            }

            if (!empty($request->input('dr'))) {
                $dr = $data['dr'];
            } else {
                $dr = '2021-01-01';
            }

            if (!empty($request->input('prioritet'))) {
                $prioritet = $data['prioritet'];
            } else {
                $prioritet = 1000;
            }


            $user = new User(
                [
                    'fio_full' => $data['name'],
                    'login' => $data['login'],
                    'password' => Hash::make($data['pasword']),
                    'tel_belki' => $tel_belki,
                    'tel_mob' => $tel_mob,
                    'room' => $room,
                    'dr' => $dr,
                    'dr' => $dr,
                    'activ' => $data['activ'],
                    'itr' => $data['itr'],
                    'prioritet' => $prioritet,
                    'show_manager' => $data['show_manager'],
                    'remember_token' => 0, /* test*/
                ]
            );

            $user->department()->associate($depart);
            $user->subdepartment()->associate($subDepart);
            $user->position()->associate($position);
            $user->save();

            $message = "Сотрудник -| " . $data['name']  . " |- успешно добавлен. Добавить ещё?";
            //return redirect()->back()->with('message', $message);
            return redirect()->route('users.create')->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->route('users.index')->with('message', $message);
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
        $user = User::where('id', $id)->first();
        $depart = $user->department;
        $departId = $user->department->id;
        $subdeparts = Subdepartmen::select('id', 'name_subdepart', 'depart_id')->where('depart_id', $departId)->orderBY('id')->get();
        $positions = Position::select('id', 'name_position')->get();
        $roles = Role::select('id', 'role_name')->get();
       
        $rolesUsers = $user->roles()->get();

        //dd($rolesUser);
        $arr = [];
        foreach( $rolesUsers as $val){
            $arr[]=$val->id;
        }
        //dd($user->activ);

        $roles = Role::select('id', 'role_name', 'role_info')
                                            ->whereNotIn('id', $arr)
                                            ->orderBy('role_name')->get();


        if (View::exists('pages.manager.533_form_edit_user')) {
            return view('pages.manager.533_form_edit_user', compact('depart', 'subdeparts', 'user', 'positions', 'roles' ,'rolesUsers'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id userEditDep
     * @return \Illuminate\Http\Response
     */
    public function userEditDep($depart, $user)
    {
        //$depart = Department::findOrFail($depart);
        $departs = Department::select('id', 'name_depart')->get();
        $user = User::findOrFail($user);


        if (View::exists('pages.manager.53_form_edit_user')) {
            return view('pages.manager.53_form_edit_user', compact('departs', 'user'));
        } else {
            abort('404');
        }
    }

    public function userEditSet(Request $request)
    {
        $data = $request->only(['name', 'login', 'selectDepart']);

        $depart = Department::findOrFail($data['selectDepart']);
        $subdeparts = Subdepartmen::select('id', 'name_subdepart', 'depart_id')->where('depart_id',  $data['selectDepart'])->orderBY('id')->get();
        $user = User::where('login', $data['login'])->first();
        $positions = Position::select('id', 'name_position')->get();
        $roles = Role::select('id', 'role_name')->get();
       
        $rolesUsers = $user->roles()->get();

        //dd($rolesUser);
        $arr = [];
        foreach( $rolesUsers as $val){
            $arr[]=$val->id;
        }
        //dd($user->activ);

        $roles = Role::select('id', 'role_name', 'role_info')
                                            ->whereNotIn('id', $arr)
                                            ->orderBy('role_name')->get();


        if (View::exists('pages.manager.533_form_edit_user')) {
            return view('pages.manager.533_form_edit_user', compact('depart', 'subdeparts', 'user', 'positions', 'roles' ,'rolesUsers'));
        } else {
            abort('404');
        }
    }






    public function edit($id)
    {
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
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }

        if ($request->isMethod('PUT')) {


            $data = $request->only([
                'name', 'login', 'departId', 'selectSubDepart', 'selectPosition',
                'activ', 'itr', 'show_manager',
                'tel_belki', 'tel_mob', 'room',
                'dr', 'prioritet', 'pasword',
            ]);

            $depart = Department::findOrFail($data['departId']);
            $subDepart = Subdepartmen::findOrFail($data['selectSubDepart']);
            $position = Position::findOrFail($data['selectPosition']);

            if (!empty($request->input('tel_belki'))) {
                $tel_belki = $data['tel_belki'];
            } else {
                $tel_belki = 'н\д';
            }

            if (!empty($request->input('tel_mob'))) {
                $tel_mob = $data['tel_mob'];
            } else {
                $tel_mob = 'н\д';
            }

            if (!empty($request->input('room'))) {
                $room = $data['room'];
            } else {
                $room = 'н\д';
            }

            if (!empty($request->input('dr'))) {
                $dr = $data['dr'];
            } else {
                $dr = '2021-01-01';
            }

            if (!empty($request->input('prioritet'))) {
                $prioritet = $data['prioritet'];
            } else {
                $prioritet = 1000;
            }

            $user = User::find($id);
            $user->fio_full = $data['name'];
            $user->login = $data['login'];
            $user->tel_belki = $tel_belki;
            $user->tel_mob = $tel_mob;
            $user->room = $room;
            $user->dr = $dr;
            $user->activ = $data['activ'];
            $user->itr = $data['itr'];
            $user->prioritet = $prioritet;
            $user->show_manager = $data['show_manager'];
            //$user->remember_token' = 0; /* test*/

            $user->department()->associate($depart);
            $user->subdepartment()->associate($subDepart);
            $user->position()->associate($position);
            $user->save();

            $message = "Данные сотрудника -| " . $data['name']  . " |- успешно изменены. Добавить сотрудника?";
            //return redirect()->back()->with('message', $message);
            return redirect()->route('users.create')->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->route('users.index')->with('message', $message);
        }
    }
    
    public function userresetrole(Request $request, $user)
    {

      if ($request->isMethod('POST')) {
        $data = $request->only(['selectRole']);
        
        $idRole = Role::findOrFail($data['selectRole']);
        $user = User::findOrFail( $user);
        
        $nameUser = $user->fio_full;
        $user->roles()->attach($idRole);

        $message = "Роль для  сотрудника -| " . $nameUser . " |- успешно добавлена.";
        return redirect()->back()->with('message', $message);
        //return redirect()->route('users.create')->with('message', $message);
    } else {
        $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
        return redirect()->route('users.index')->with('message', $message);
    }
}

        public function userdeletrole (Request $request, $user)
        {

            if ($request->isMethod('DELETE')) {
                $data = $request->only(['roleId']);
                
                $idRole = Role::findOrFail($data['roleId']);
                $user = User::findOrFail( $user);
                
                $nameUser = $user->fio_full;
                $user->roles()->detach($idRole->id);

                $message = "Роль для  сотрудника -| " . $nameUser . " |- успешно удалена.";
                return redirect()->back()->with('message', $message);
                //return redirect()->route('users.create')->with('message', $message);
            } else {
                $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
                return redirect()->route('users.index')->with('message', $message);
            }
        }


        public function userresetpaswd(Request $request)
        {

          if ($request->isMethod('POST')) {
            $data = $request->only(['pasword', 'userId']);

            $rules = [
                'pasword' => ['required',  'min:6'],
            ];

            $this->validate($request, $rules);

            $user = User::findOrFail($data['userId']);
            $nameUser = $user->fio_full;
            $user->password = Hash::make($data['pasword']);
            $user->save();
            $message = "Пароль сотрудника -| " . $nameUser . " |- успешно изменён. Создать сотрудника?";
            //return redirect()->back()->with('message', $message);
            return redirect()->route('users.create')->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->route('users.index')->with('message', $message);
        }
    }



       public function usersearch(Request $request)
       {
        
          $data= $request->only('search');

          $users = User::with('department', 'subdepartment', 'position')->select(
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
                                 )->where('fio_full', 'LIKE', '%'.$data['search'].'%')->orderBy('fio_full')->paginate(15);

        $userCount = $users->count();

        if (View::exists('pages.manager.51_list_user_catalogs')) {

            return view('pages.manager.51_list_user_catalogs', compact('users', 'userCount'));
        } else {

            return redirect()->to('404');
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
        //dd($id);
        $user = User::findOrFail($id);
        $name  = $user->fio_full;

        $countRoles =$user->roles()->count();

        if($countRoles > 0){
            $message = "Прежде чем удалить сотрудника  -| " . $name  . " |- необходимо удалить все его роли: ". $countRoles;
            return redirect()->back()->with('message_info', $message);
        }




        $user->destroy($id);

        $message = "Сотрудник -| " . $name  . " |- был удалён!";
        return redirect()->route('users.create')->with('message', $message);
    }
}

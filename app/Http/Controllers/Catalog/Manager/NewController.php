<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\User;
use App\Models\Newst;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Gate;

class NewController extends Controller
{

    //--- только для admin и manager_main
    public function isRight()  
    {
        $user = Auth::user();
        $arrRoles = [];
        foreach ($user->roles as $role) {
            $arrRoles[] = $role->role_name;
        }

        foreach ($arrRoles as $role) {

            if ($role == 'admin') {
                return true;
            }
            if ($role == 'manager_main') {
                return true;
            }
            /*  только для 
            if ($role == 'manager') {
                return true;
            }
            if ($role == 'operator') {
                return true;
            }
            */
            return false;
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ---для проверки доступа
        //----isRight()
        //dd(Gate::denies('show_manager_main') || Gate::denies('show_admin'));

        //проверка прав; этот ресурс можно только с ролью admin  и manager_main

        if (!($this->isRight())) {
            return redirect()->route('welcome'); //('no_access'); 
        }

        $news = Newst::with('user')->select('id', 'user_id', 'news_post', 'news_info', 'news_activ', 'created_at', 'updated_at')
            ->orderBy('updated_at', 'DESC')->paginate(10);

        if (View::exists('pages.manager.91_list_news_catalogs')) {
            return view('pages.manager.91_list_news_catalogs', ['news' => $news]);
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id Svodka 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $newOne = Newst::findOrFail($id);
        if (View::exists('pages.manager.94_form_show_news')) {
            return view('pages.manager.94_form_show_news', compact('newOne'));
        } else {
            abort('404');
        }
    }


    public function newssearch(Request $request)
    {

        $data = $request->only('search');

        $news = Newst::with('user')->select('id', 'user_id', 'news_post', 'news_info', 'news_activ', 'created_at', 'updated_at')
            ->where('news_post', 'LIKE', '%' . $data['search'] . '%')
            ->orderBy('updated_at', 'DESC')->paginate(10);

        if (View::exists('pages.manager.91_list_news_catalogs')) {
            return view('pages.manager.91_list_news_catalogs', ['news' => $news]);
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();

        if (View::exists('pages.manager.92_form_create_news')) {
            return view('pages.manager.92_form_create_news', compact('user'));
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
        /*if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }
        */

        if ($request->isMethod('POST')) {

            $data = $request->only([
                'post', 'userId', 'info', 'activ',
            ]);

            $rules = [
                'post' => ['required',  'min:3'],
                'info' => ['required'],
            ];

            $this->validate($request, $rules);

            $userId = User::findOrFail($data['userId']);

            $newst = new Newst(
                [
                    'news_post' => $data['post'],
                    'news_info' => $data['info'],
                    'news_activ' => $data['activ'],
                ]
            );


            $newst->user()->associate($userId);
            //dd(1);
            $newst->save();


            $message = "Новость -| " . $data['post']  . " |- успешно добавлена. Добавить ещё?";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->route('news.index')->with('message', $message);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $newOne = Newst::findOrFail($id);
        //dd($newOne);
        if (View::exists('pages.manager.93_form_edit_news')) {
            return view('pages.manager.93_form_edit_news', compact('newOne'));
        } else {
            abort('404');
        }
    }

    public function update(Request $request,  $id)
    {
        /* if (Gate::denies('show_admin')) {
            return redirect()->route('welcome');//('no_access');
        }
        */

        if ($request->isMethod('PUT')) {

            $data = $request->only(['post', 'newId', 'info', 'activ']);

            $rules = [
                'post' => ['required',  'max:200'],
                'info' => ['required',  'max:7000'],

            ];

            $this->validate($request, $rules);

            $newOne1 = Newst::findOrFail($data['newId']);

            $user = Auth::user();

            if ($user->id == $newOne1->user->id) {
                $newOne1->news_post = $data['post'];
                $newOne1->news_info = $data['info'];
                $newOne1->news_activ = $data['activ'];

                $newOne1->save();

                $message = "Новость -| " . $data['post']  . " |- успешно изменена. Изменить ещё?";
                return redirect()->back()->with('message', $message);
            } else {
                $message_info = "Новость -| " . $data['post']  . " |- нельзя изменить, она не ваша.";
                return redirect()->back()->with('message_info', $message_info);
            }
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Svod  $svod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //защита от удаления $del
        $del = Config::get('constants.options.no_delet_projects');

        $newOn1 = Newst::findOrFail($id);

        if ($newOn1->news_activ == 1) {
            $message = "Новость -| " . $newOn1->news_post  . " |- включена для показа, удалить невозможно.";
            return redirect()->back()->with('message_info', $message);
        }

        $newOn1->destroy($id);

        $message = "Новость -| " . $newOn1->news_post . " |- была удалена.";
        return redirect()->route('news.index')->with('message_info', $message);
    }
}

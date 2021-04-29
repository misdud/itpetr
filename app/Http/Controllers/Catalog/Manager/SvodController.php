<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\User;
use App\Models\Svod;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Gate;

class SvodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //parent::__construct();
        // ---для проверки доступа
        //----isAdmin
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome'); //('no_access');
        }

        $svods = Svod::with('user')->select('id', 'user_id', 'post', 'info', 'created_at', 'updated_at')->orderBy('updated_at', 'DESC')->paginate(10);

        if (View::exists('pages.manager.81_list_svodks_catalogs')) {
            return view('pages.manager.81_list_svodks_catalogs', ['svods' => $svods]);
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

        if (View::exists('pages.manager.82_form_create_svodks')) {
            return view('pages.manager.82_form_create_svodks', compact('user'));
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
            return redirect()->route('welcome'); //('no_access');
        }

        if ($request->isMethod('POST')) {

            $data = $request->only([
                'post', 'userId', 'info',
            ]);

            $rules = [
                'post' => ['required',  'min:3'],
                'info' => ['required'],
            ];

            $this->validate($request, $rules);

            $userId = User::findOrFail($data['userId']);

            $svodk = new Svod(
                [
                    'post' => $data['post'],
                    'info' => $data['info'],
                ]
            );

            $svodk->user()->associate($userId);
            $svodk->save();

            $message = "Сводка -| " . $data['post']  . " |- успешно добавлена. Добавить ещё?";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->route('svodks.index')->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id Svodka 
     * @return \Illuminate\Http\Response
     */
    public function show(Svod $svod, $id)
    {


        $svodka = Svod::findOrFail($id);
        if (View::exists('pages.manager.822_form_show_svodk')) {
            return view('pages.manager.822_form_show_svodk', compact('svodka'));
        } else {
            abort('404');
        }
    }

    public function postsearch(Request $request)
    {

        $data = $request->only('search');

        $svods = Svod::with('user')->select('id', 'user_id', 'post', 'info', 'created_at', 'updated_at')
            ->where('post', 'LIKE', '%' . $data['search'] . '%')
            ->orderBy('updated_at', 'DESC')->paginate(10);

        if (View::exists('pages.manager.81_list_svodks_catalogs')) {
            return view('pages.manager.81_list_svodks_catalogs', ['svods' => $svods]);
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Svod  $svod
     * @return \Illuminate\Http\Response
     */
    public function edit(Svod $svod, $id)
    {
        $svodka = Svod::findOrFail($id);
        if (View::exists('pages.manager.83_form_edit_svodks')) {
            return view('pages.manager.83_form_edit_svodks', compact('svodka'));
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Svod  $svod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Svod $svod, $id)
    {
        if (Gate::denies('show_admin')) {
            return redirect()->route('welcome'); //('no_access');
        }

        if ($request->isMethod('PUT')) {

            $data = $request->only(['post', 'info']);

            $rules = [
                'post' => ['required',  'max:200'],
                'info' => ['required',  'max:7000'],

            ];

            $this->validate($request, $rules);

            $svodka = Svod::findOrFail($id);

            $user = Auth::user();
            
            if ($user->id == $svodka->user->id) {
                $svodka->post = $data['post'];
                $svodka->info = $data['info'];

                $svodka->save();

                $message = "Сводка -| " . $data['post']  . " |- успешно изменена. Изменить ещё?";
                return redirect()->back()->with('message', $message);
            }else{
                $message_info = "Сводку -| " . $data['post']  . " |- нельзя изменить, она не ваша.";
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
    public function destroy(Svod $svod, $id)
    {
        //защита от удаления $del
        $del = Config::get('constants.options.no_delet_projects');
        $svodka = Svod::findOrFail($id + $del);
        $svodkaName = $svodka->post;
        $svodka->destroy($id);

        $message = "Сводка -| " . $svodkaName  . " |- была удалена.";
        return redirect()->route('svodks.index')->with('message_info', $message);
    }
}

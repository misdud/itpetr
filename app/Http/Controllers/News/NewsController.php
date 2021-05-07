<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use App\Models\Newst;


class NewsController extends Controller
{

    public function index()
    {
        //----выборка для списка новостей (только активных)
        $news = Newst::select(
            'id',
            'user_id',
            'news_post',
            'news_info',
            'news_activ',
            'updated_at',
            'created_at',
        )
            ->where('news_activ', 1)
            ->orderBy('created_at', 'DESC')->paginate(10);

        $newsCount = Newst::where('news_activ', 1)->count();

        if (View::exists('news.news_list')) {

            return view('news.news_list', compact('news', 'newsCount'));
        } else {

            return redirect()->to('404');
        }
    }

    //----показ одной новости
    public function showOne($id){

        $newOne = Newst::findOrFail($id);
       
        if (View::exists('news.news_one_show')) {

            return view('news.news_one_show', compact('newOne'));
        } else {
            return redirect()->to('404');
        }

    }
}

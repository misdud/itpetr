<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DocumentsController extends Controller
{
    public function showCollectivDogovor(){
        //$showTopMenu = true;
        if (View::exists('documents.all_documents')) {
            return view('documents.all_documents',['isShowSidebarClass'=>true, 'showTopMenu'=>true, 'isShowFooter'=>false]);
         }
         abort('404');
    }
}

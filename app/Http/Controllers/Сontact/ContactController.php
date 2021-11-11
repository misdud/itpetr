<?php

namespace App\Http\Controllers\Сontact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;

class ContactController extends Controller
{

    public function showListContact()
    {

        $users = User::with('department', 'subdepartment', 'position')
            ->select(
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
                'room',
                'created_at'
            )
            ->where('activ',  1)
            ->orderByRaw('fio_full')
            ->paginate(15);

        if (View::exists('contacts.show_list_contact')) {
            return view('contacts.show_list_contact', ['isShowSidebarClass' => true, 'showTopMenu' => true, 'isShowFooter' => false, 'users' => $users, 'contact' => 'list_contact']);
        }
        abort('404');
    }

    public function searchContact(Request $request)
    {

        $data = $request->only('search');

        if (empty($data['search'])) {
            return $this->showListContact();
        } else {
            $users = User::select(
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
                'room',
                'created_at'
            )
                ->where('activ', 1)
                ->where('fio_full', 'LIKE', '%' . $data['search'] . '%')
                ->orderBy('fio_full')->paginate(50);
                
                if (View::exists('contacts.show_list_contact')) {
                    return view('contacts.show_list_contact', ['isShowSidebarClass' => true, 'showTopMenu' => true, 'isShowFooter' => false, 'users' => $users, 'contact' => 'list_contact']);
                }
                abort('404');

        }
    }


    public function showAllContactPDF()
    {
        //$showTopMenu = true;
        if (View::exists('contacts.all_contact')) {
            return view('contacts.all_contact', ['isShowSidebarClass' => true, 'showTopMenu' => true, 'isShowFooter' => false]);
        }
        abort('404');
    }
}

<?php

namespace App\Http\Controllers\Birthday;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\User;

//use Carbon\Carbon;

class MainBirthdayController extends Controller
{
    public function drToday()
    {

            // birthdays users ------- у которых ближайшее день рождение -------7 дней
            //-original -- $birthdays = User::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dr) AND DAYOFYEAR(curdate()) + 0 >=  dayofyear(dr)')-> ->orderByRaw('DAYOFYEAR(dr)')->get();
            //$birthdays = User::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dr) AND DAYOFYEAR(curdate()) + 0 >=  dayofyear(dr)')
            $users = User::with('department', 'subdepartment', 'position')
            ->whereRaw('DAYOFYEAR(curdate()) = DAYOFYEAR(dr)')
            ->where('activ',  1)
            ->orderByRaw('DAYOFYEAR(dr)')
            ->paginate(15);
  

        $botton = 'dr_today';

        $date = date('d-m-Y').'г.';

        if (View::exists('birthdays.birthday_show_list')) {
            return view('birthdays.birthday_show_list', compact('users', 'botton', 'date'));
        } else {
            abort('/404');
        }
    }

    public function drTomorrow()
    {
        //$tomorrow = date('Y-m-d');

         // $t = strtotime('+1 day 00:00:00');
          //echo 'Timestamp: '.$t;
          //echo 'Datetime: '.date('Y-m-d H:i:s',$t); 

          $d = strtotime("+1 day");
          $tomorrow = date("Y-m-d", $d);

          $users = User::with('department', 'subdepartment', 'position')
            ->whereRaw('DAYOFYEAR(curdate()) < DAYOFYEAR(dr) AND DAYOFYEAR(curdate()) + 5 >=  dayofyear(dr)')
            ->where('activ',  1)
            ->orderByRaw('DAYOFYEAR(dr)')
            ->paginate(15);

        $botton = 'dr_tomorrow';

        $d1 = strtotime("+1 day");
        $d5 = strtotime("+5 day");
        $date = 'c ' .date("d-m-Y", $d1).'г. по '.date("d-m-Y", $d5).'г.';

        if (View::exists('birthdays.birthday_show_list')) {
            return view('birthdays.birthday_show_list', compact('users', 'botton', 'date'));
        } else {
            abort('/404');
        }
    }

    public function drListPDF()
    {

        $botton = 'dr_listPDF';
        
        $dateMount = date('m');
        //dd($dateMount);

        if (View::exists('birthdays.birthday_file')) {
            return view('birthdays.birthday_file', compact('botton','dateMount' ));
        } else {
            abort('/404');
        }
    }
}

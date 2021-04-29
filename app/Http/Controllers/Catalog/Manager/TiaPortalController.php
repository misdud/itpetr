<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

use Acamposm\Ping\Ping;
use Acamposm\Ping\PingCommandBuilder;

use App\Models\ProjectTIA;

use Gate;

class TiaPortalController extends Controller
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
        
        $projects = ProjectTIA::with('projectwinccs')->select(
                                        'id',
                                        'organization',
                                        'name',
                                        'fio_dev',
                                        'tel_dev',
                                        'ip',
                                        'room_set',
                                        'info',
                                        'updated_at',
                                        'created_at',
                         )->orderBy('room_set')->paginate(15);

        $projectCount = ProjectTIA::count();

          /* foreach($projects as $project){
             echo $project->projectwinccs()->count();
            }
          */
        if (View::exists('pages.manager.71_list_projecttia_catalogs')) {

            return view('pages.manager.71_list_projecttia_catalogs', compact('projects', 'projectCount'));
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
        if (View::exists('pages.manager.72_form_create_projecttia')) {
            return view('pages.manager.72_form_create_projecttia');
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

            $data = $request->only(['nameOrganization', 'nameProject',  'ip', 'fio', 'tel', 'map', 'info']);

            $rules = [
                'nameOrganization' => ['required',  'max:250'],
                'nameProject' => ['unique:App\Models\ProjectTIA,name', 'required',  'max:250'],
                'fio' => ['max:250'],
                'ip' => ['required'],
                'tel' => ['max:250'],
                'map' => ['required', 'max:250'],
                'info' => ['max:999'],
            ];

            $this->validate($request, $rules);



            ProjectTIA::create([
                'organization' => $data['nameOrganization'],
                'name' => $data['nameProject'],
                'fio_dev' => $data['fio'],
                'tel_dev' => $data['tel'],
                'ip' => $data['ip'],
                'room_set' => $data['map'],
                'info' => $data['info'],
            ]);

            $message = "Проект -| " . $data['nameProject']  . " |- успешно создан. Создать ещё?";
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
        //dd($id);
        $project = ProjectTIA::findOrFail($id);
        $projectWinCCs = $project->projectwinccs()->orderBy('name_otdelenie')->get();
        //dd($project);

        if (View::exists('pages.manager.722_form_show_projecttia')) {
            return view('pages.manager.722_form_show_projecttia', compact('project', 'projectWinCCs'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = ProjectTIA::findOrFail($id);

        if (View::exists('pages.manager.73_form_edit_projecttia')) {
            return view('pages.manager.73_form_edit_projecttia', compact('project'));
        } else {
            abort('404');
        }
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
        // ---для проверки доступа
        //isAdmin
        // if(Gate::denies('show_users_admin')){
        //     return redirect()->route('no_access');
        //}

        if ($request->isMethod('PUT')) {

            $data = $request->only(['nameOrganization', 'nameProject',  'ip', 'fio', 'tel', 'map', 'info']);

            $rules = [
                'nameOrganization' => ['required',  'max:250'],
                'nameProject' => ['required',  'max:250'],
                'fio' => ['max:250'],
                'ip' => ['required'],
                'tel' => ['max:250'],
                'map' => ['required', 'max:250'],
                'info' => ['max:999'],
            ];

            $this->validate($request, $rules);

            $dataProject =ProjectTIA::findOrFail($id);

            $dataProject->organization = $data['nameOrganization'];
            $dataProject->name = $data['nameProject'];
            $dataProject->fio_dev = $data['fio'];
            $dataProject->tel_dev = $data['tel'];
            $dataProject->ip = $data['ip'];
            $dataProject->room_set = $data['map'];
            $dataProject->info = $data['info'];

            $dataProject->save();

            $message = "Проект -| " . $data['nameProject']  . " |- успешно изменён. Изменить ещё?";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }

       public function mypingtia($id)
       {
         function myping($host)
        {
            exec("ping -n 3 " . $host, $output, $result);
    
            $arr = [];
            foreach ($output as $key => $out) {
                if(($key == 0) || ($key == 5) || ($key == 9) || ($key == 10)) continue;
                $arr[] = iconv("IBM866", "UTF-8", $out);
            }
                 return [$arr, $result];
            /*if ($result == 0)
                echo "Ping successful!";
            else
                echo "Ping unsuccessful!";*/
        }
          $project = ProjectTIA::findOrFail($id);
          $projectWinCCs = $project->projectwinccs;
        
          $arrAllResult=myping($project->ip);
          $arrPingResult=$arrAllResult[0];
          $result=$arrAllResult[1];
          //dd($arrAllResult);

          if (View::exists('pages.manager.722_form_show_projecttia')) {
              return view('pages.manager.722_form_show_projecttia', compact('project', 'arrPingResult', 'result', 'projectWinCCs'));
          } else {
              abort('404');
          }

       }

        //search progectTia
       public function projecttiasearch(Request $request)
       {
        $data= $request->only('search');

        $projects = ProjectTIA::select(
                                        'id',
                                        'organization',
                                        'name',
                                        'fio_dev',
                                        'tel_dev',
                                        'ip',
                                        'room_set',
                                        'info',
                                        'updated_at',
                                        'created_at',
                                 )->where('room_set', 'LIKE', '%'.$data['search'].'%')->orderBy('room_set')->paginate(15);

        $projectCount = $projects->count();

        if (View::exists('pages.manager.71_list_projecttia_catalogs')) {

            return view('pages.manager.71_list_projecttia_catalogs', compact('projects', 'projectCount'));
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
       //проверять ссылки перед удалением
        $del=Config::get('constants.options.no_delet_projects');
       
        $project = ProjectTIA::findOrFail($id+$del);
        $name  = $project->name;

        //ищём ссылки на проекты перед удвлением
        $countWinCCproject = $project->projectwinccs()->count();
 
        //dd($countWinCCproject);

        if( $countWinCCproject > 0){
            $message = "Прежде чем удалить  проект TIA Portal(контроллер)  -| " . $name  . " |- необходимо удалить ссылки на проекты WinCC: ".  $countWinCCproject;
            return redirect()->back()->with('message_info', $message);
        }


        $project->destroy($id);
       
        $message = "Вся информация по проекту  -| " . $name  . " |- была удалёна!";
        return redirect()->route('projecttias.index')->with('message', $message);
    }
}

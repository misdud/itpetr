<?php

namespace App\Http\Controllers\Catalog\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

use App\Models\ProjectWinCC;
use App\Models\ProjectTIA;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = ProjectWinCC::select(
            'id',
            'name_project',
            'create_project',
            'name_otdelenie',
            'name_controller',
            'map_project',
            'tel_project',
            'info_project',
            'updated_at'
        )->orderBy('name_otdelenie')->paginate(10);
        $projectCount = ProjectWinCC::count();
        //dd( $projects);

        if (View::exists('pages.manager.61_list_project_catalogs')) {

            return view('pages.manager.61_list_project_catalogs', compact('projects', 'projectCount'));
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
        if (View::exists('pages.manager.62_form_create_project')) {
            return view('pages.manager.62_form_create_project');
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

            $data = $request->only(['nameOtdel', 'nameProject', 'razrabotchik',   'controller', 'tel', 'map', 'info']);

            $rules = [
                'nameOtdel' => ['required',  'max:250'],
                'nameProject' => ['unique:App\Models\ProjectWinCC,name_project', 'required',  'max:250'],
                'razrabotchik' => ['required',  'max:250'],
                'tel' => ['max:250'],
                'map' => ['max:250'],
                'info' => ['max:250'],
            ];

            $this->validate($request, $rules);
            
            if (!empty($request->input('info'))) {
                $info = $data['info'];
            } else {
                $info = 'н\д';
            }



            ProjectWinCC::create([
                'name_otdelenie' => $data['nameOtdel'],
                'name_project' => $data['nameProject'],
                'name_controller' => $data['controller'],
                'create_project' => $data['razrabotchik'],
                'tel_project' => $data['tel'],
                'map_project' => $data['map'],
                'info_project' => $info,
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
        $project = ProjectWinCC::findOrFail($id);
        $projectTias= $project->projecttias()->orderBy('room_set')->get();
        //dd($projectTias);

        if (View::exists('pages.manager.622_form_show_project')) {
            return view('pages.manager.622_form_show_project', compact('project','projectTias'));
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
        $project = ProjectWinCC::findOrFail($id);
        $projectTias= $project->projecttias()->get();
        $arr = [];
        foreach( $projectTias as $val){
            $arr[]=$val->id;
        }
        //dd($arr);

        $projectTiasSelectInput = ProjectTIA::select('id', 'organization', 'name', 'room_set', 'ip')
                                                    ->whereNotIn('id', $arr)
                                                    ->orderBy('ip')->get();

        if (View::exists('pages.manager.63_form_edit_project')) {
            return view('pages.manager.63_form_edit_project', compact('project', 'projectTias', 'projectTiasSelectInput'));
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

            $data = $request->only(['nameOtdel', 'nameProject', 'razrabotchik', 'controller', 'tel', 'map', 'info']);

            $rules = [
                'nameOtdel' => ['required',  'max:250'],
                'nameProject' => ['required',  'max:250'],
                'razrabotchik' => ['required',  'max:250'],
                'tel' => ['max:250'],
                'map' => ['max:250'],
                'info' => ['max:250'],
            ];

            $this->validate($request, $rules);

            $dataProject = ProjectWinCC::findOrFail($id);

            $dataProject->name_otdelenie = $data['nameOtdel'];
            $dataProject->name_project = $data['nameProject'];
            $dataProject->name_controller = $data['controller'];
            $dataProject->create_project = $data['razrabotchik'];
            $dataProject->tel_project = $data['tel'];
            $dataProject->map_project = $data['map'];
            $dataProject->info_project = $data['info'];

            $dataProject->save();

            $message = "Проект -| " . $data['nameProject']  . " |- успешно изменён. Изменить ещё?";
            return redirect()->back()->with('message', $message);
        } else {
            $message = 'Произошла ошибка при создании записи, обратитесь к администратору.';
            return redirect()->back()->with('message', $message);
        }
    }
       //searchwinccproject
       public function projectwinccsearch(Request $request)
       {
        $data= $request->only('search');

        $projects = ProjectWinCC::select(
                                        'id',
                                        'name_project',
                                        'create_project',
                                        'name_otdelenie',
                                        'name_controller',
                                        'map_project',
                                        'tel_project',
                                        'info_project',
                                        'updated_at'
                                 )->where('name_otdelenie', 'LIKE', '%'.$data['search'].'%')->orderBy('name_otdelenie')->paginate(15);

        $projectCount = $projects->count();

        if (View::exists('pages.manager.61_list_project_catalogs')) {

            return view('pages.manager.61_list_project_catalogs', compact('projects', 'projectCount'));
        } else {

            return redirect()->to('404');
        }
       }
        public function projectwinlinktia(Request $request)
        {
            $data= $request->only('selectTia','projectWinId', 'info');
           
            $dataProjectWinCC = ProjectWinCC::findOrFail($data['projectWinId']);
            $dataProjectTIA = ProjectTIA::findOrFail($data['selectTia']);
            $idTia = $dataProjectTIA->id;
            $name = $dataProjectTIA->name;

            if (!empty($request->input('info'))) {
                $info = $data['info'];
            } else {
                $info = 'н\д';
            }

            $dataProjectWinCC->projecttias()->attach($idTia, ['info_controller'=> $info]);

            $message = "Контроллер -| " . $name  . " |- успешно привязан к проекту ". $dataProjectWinCC->name_project.".";
            return redirect()->back()->with('message', $message);

        }

        public function projectwindeletlinktia($tiaid,Request $request )
        {
            //dd(1);
            
            $data= $request->only('projectWinID');
           
            $dataProjectWinCC = ProjectWinCC::findOrFail($data['projectWinID']);
            $dataProjectTIA = ProjectTIA::findOrFail($tiaid);
            $idTia = $dataProjectTIA->id;
            $name = $dataProjectTIA->name;


            $dataProjectWinCC->projecttias()->detach($idTia);

            $message = "Контроллер -| " . $name  . " |- успешно отвязан от проекта ". $dataProjectWinCC->name_project.".";
            return redirect()->back()->with('message', $message);

        }
    
    
    
    public function myping($host)
    {
        exec("ping -n 3 " . $host, $output, $result);

        $arr = [];
        foreach ($output as $key => $out) {
            $arr[] = iconv("IBM866", "UTF-8", $out);
        }
        var_dump($arr);
        if ($result == 0)
            echo "Ping successful!";
        else
            echo "Ping unsuccessful!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $del=Config::get('constants.options.no_delet_projects');
        //dd($del);
        $project = ProjectWinCC::findOrFail($id+$del);
        $name  = $project->name_project;
        
        //проверять ссылки перед удалением 
        $countTiaController = $project->projecttias()->count();

        if($countTiaController > 0){
            $message = "Прежде чем удалить проект  -| " . $name  . " |- необходимо удалить привязанные контроллеры: ". $countTiaController;
            return redirect()->back()->with('message_info', $message);
        }

        $project->destroy($id);
       
        $message = "Вся информация по проекту  -| " . $name  . " |- была удалёна!";
        return redirect()->route('projectwinccs.index')->with('message', $message);
    }
}

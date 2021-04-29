@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links_wincctia', ['test'=>'projectTIA'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Просмотр сведений по проекту
                            <span class="font-weight-bold">&#9658; {{ $project->name }}</span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('projecttias.index') }}">Проекты TIA Portal</a> &#9658;</p>
                    </div>

                    @if ($errors->any())
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.errors')
                    </div>
                    @endif

                    <div>
                        <ul class="list-group list-group-flush pt-3 ml-4 mr-4">
                            <li class="list-group-item"><b>Отделение\помещение: </b> {{ $project->room_set }}</li>
                            <li class="list-group-item"><b>Организация:</b> {{ $project->organization }}</li>
                            <li class="list-group-item"><b>Имя проекта:</b> {{ $project->name }}</li>
                            <li class="list-group-item"><b>Разработчик проекта: </b>{{ $project->fio_dev }}</li>
                            <li class="list-group-item"><b>Телефон:</b> {{ $project->tel_dev }}</li>
                            <li class="list-group-item"><b>IP:</b> &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-primary btn-sm " href="{{ route('ping_tia', ['id'=>$project->id] ) }}"> {{ $project->ip }} ПНУТЬ</a>
                            @if(isset($result) && $result == 0)
                                 &#9658;<span class="bg-success border-success rounded text-white p-1">  ЖИВОЙ</span>
                            @elseif(isset($result) && $result == 1)
                                 &#9658;<span class="bg-danger border-success rounded text-white p-1">  МЁРТВЫЙ</span>
                            @endif
                            @if(!empty($arrPingResult))<br>
                            @forelse($arrPingResult as $key=>$resultinf)

                                    <small class="form-text text-muted">
                                     @if($key > 3) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     @endif
                                    {{ $resultinf }}</small>       
                                @empty
                                <p class="pl-3">Не найдены</p>
                                @endforelse
                            @else
                            @endif
                            </li>
                            <li class="list-group-item"><b>Примечание: </b> {{ $project->info }}</li>
                            <li class="list-group-item"><b>Создан в справочнике:</b> {{ date('d-m-Y H:i:s', strtotime($project->created_at)) }}</li>
                            <li class="list-group-item pb-3"><b>Обновлен в справочнике:</b> {{ date('d-m-Y H:i:s', strtotime($project->updated_at))  }}</li>
                        </ul>
                    </div>
                    <p><a class="btn  btn-info btn-fill float-right mr-4" href="{{ route('projecttias.index') }}">Назад </a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                  @if( count($projectWinCCs))
                    <table class="table table-sm table-responsive-xxl">
                        <thead>
                        <tr>
                            <th colspan="7" class="table-active">Проекты WinCC контроллера:  <span  class="text-primary"><b>{{ $project->ip }} &#9658; {{ $project->name }}</b></span></th>
                        </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Отделение</th>
                                <th scope="col">Проект</th>
                                <th scope="col">Разработчик</th>
                                <th scope="col">Контакты:</th>
                                <th scope="col">Нахождение:</th>
                                <th scope="col"> <acronym title="Кличество контроллеров в WinCC проекте">Контроллеров<acronym></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projectWinCCs as $key=>$projectWinCC)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><acronym title="Создан: {{ $projectWinCC->pivot->created_at }}">{{ mb_strimwidth($projectWinCC->name_otdelenie, 0, 30, "...") }}</acronym></td>
                                <td> <a class="bg-primary rounded p-2 text-light" href="{{ route('projectwinccs.show', ['projectwincc'=>$projectWinCC->id ] ) }}"><i class="nc-icon nc-app  pl-1 pr-1 "> {{  mb_strimwidth($projectWinCC->name_project, 0, 30, "...") }}</a></td>
                                
                                <td> {{  mb_strimwidth($projectWinCC->create_project, 0, 30, "...") }}</td> 
                                <td>{{  mb_strimwidth($projectWinCC->tel_project, 0, 30, "...") }}</td>
                                <td>{{  mb_strimwidth($projectWinCC->map_project, 0, 30, "...") }}</td>
                                <td>  <acronym title="Кличество контроллеров в этом проекте"><a class="border_bottom" href="{{ route('projectwinccs.show', ['projectwincc'=>$projectWinCC->id ] ) }}">{{ $projectWinCC->projecttias()->count() }}</a><acronym></td>
                            </tr>
                            @empty
                            <p class="pt-3 pl-4">Cсылок не найдено.</p>
                            @endforelse
                        </tbody>
                    </table>
 
                    <p class="ml-2 pt-2 border-top">Всего: {{ $projectWinCCs->count() }}</p>
                    @else
                     <p class="pt-3 pl-4">Cсылок на проеты не найдены.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
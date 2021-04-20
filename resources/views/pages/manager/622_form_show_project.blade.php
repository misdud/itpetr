@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'projectWinCC'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Просмотр сведений по проекту
                            <span class="font-weight-bold">&#9658; {{ $project->name_project }}</span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('projectwinccs.index') }}">Проекты WinCC</a> &#9658;</p>
                    </div>

                    @if ($errors->any())
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.errors')
                    </div>
                    @endif

                    <div>
                        <ul class="list-group list-group-flush pt-3 ml-4 mr-4">
                            <li class="list-group-item"><b>Отделение:</b> {{ $project->name_otdelenie }}</li>
                            <li class="list-group-item"><b>Имя проекта:</b> {{ $project->name_project }}</li>
                            <li class="list-group-item"><b>Разработчик проекта: </b>{{ $project->create_project }}</li>
                            <li class="list-group-item"><b>Телефон:</b> {{ $project->tel_project }}</li>
                            <li class="list-group-item"><b>Сведения по контроллерам:</b> {{ $project->name_controller }}</li>
                            <li class="list-group-item"><b>Место нахождения проекта: </b> {{ $project->map_project }}</li>
                            <li class="list-group-item"><b>Примечание:</b> {{ $project->info_project }}</li>
                            <li class="list-group-item"><b>Создан в справочнике:</b> {{ date('d-m-Y H:i:s', strtotime($project->created_at)) }}</li>
                            <li class="list-group-item pb-3"><b>Обновлен в справочнике:</b> {{ date('d-m-Y H:i:s', strtotime($project->updated_at))  }}</li>
                        </ul>
                    </div>
                    <p><a class="btn  btn-info btn-fill float-right mr-4" href="{{ route('projectwinccs.index') }}">Назад </a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                  @if( count($projectTias))
                    <table class="table table-sm table-responsive-xxl">
                        <thead>
                        <tr>
                            <th colspan="7" class="table-active">Контроллеры проекта  <span  class="text-primary"><b>{{ $project->name_project }}</b></span></th>
                        </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Отделение\Vtcnj</th>
                                <th scope="col">Имя проекта:</th>
                                <th scope="col">ip</th>
                                <th scope="col">Пинг</th>
                                <th scope="col">Ссылочная инфа:</th>
                                <th scope="col"> <acronym title="Кличество WinCC проектов на контроллере">WinCC<acronym></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projectTias as $key=>$projecttia)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td> {{  mb_strimwidth($projecttia->room_set, 0, 30, "...") }}</td>
                                <td><a class="bg-success rounded text-secondary p-2" href="{{ route('projecttias.show', ['projecttia'=>$projecttia->id ] ) }}"><i class="nc-icon nc-grid-45  pl-1 pr-1"> {{ mb_strimwidth($projecttia->name, 0, 30, "...") }}</a></td>
                                <td><acronym title="Создан: {{ $projecttia->pivot->created_at }}"><a href="http://{{ $projecttia->ip }}">{{ $projecttia->ip }}</a></acronym></td>
                                <td> <a  href="{{ route('ping_tia', ['id'=>$projecttia->id] ) }}"> ПНУТЬ</a></td>
                                <td><acronym title="Инфа: {{ $projecttia->pivot->info_controller }}">{{ mb_strimwidth($projecttia->pivot->info_controller, 0, 30, "...") }}</acronym></td>
                                <td> <acronym title="Кличество WinCC проектов на контроллере"><a  href="{{ route('projecttias.show', ['projecttia'=>$projecttia->id] ) }}">{{ $projecttia->projectwinccs()->count() }}<acronym></a></td>
                            </tr>
                            @empty
                            <p class="pt-3 pl-4">Cсылок не найдено.</p>
                            @endforelse
                        </tbody>
                    </table>
 
                    <p class="ml-2 pt-2 border-top">Всего: {{ $projectTias->count() }}</p>
                    @else
                     <p class="pt-3 pl-4">Cсылок на контроллеры не найдено.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
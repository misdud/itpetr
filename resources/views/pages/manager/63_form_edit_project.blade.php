@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links_wincctia', ['test'=>'projectWinCC'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Изменение записи в справочнике
                            <span class="font-weight-bold"> Проекты WinCC </span> &#9658; {{ $project->name_project }}
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('projectwinccs.index') }}">Проекты WinCC </a> &#9658;</p>
                    </div>

                    @if ($errors->any())
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.errors')
                    </div>
                    @endif

                    @if (session('message'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.success')
                    </div>
                    @endif
                                        
                    @if (session('message_info'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.info')
                    </div>
                    @endif
         
                    <div class="float-right">
                        <form class="float-right mr-3" action="{{ route('projectwinccs.destroy', ['projectwincc'=>$project->id ] ) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn  btn-danger btn-fill nc-icon nc-simple-remove p-2"> Удалить проект: <b>{{ $project->name_project }}</b></button>
                        </form>
                    </div>

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('projectwinccs.update', ['projectwincc'=>$project->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <legend>Заполните поля ниже:</legend>
                            <div class="row border border-info rounded m-1">
                                <div class="col pt-3">
                                    <div class="form-group">
                                        <label for="nameOtdel">Отделение</label>
                                        <input type="text" name="nameOtdel" class="form-control" id="nameOtdel" value="{{ $project->name_otdelenie }} required">
                                        <small id="name" class="form-text text-muted">Отделение где используется проект.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Наименование проекта</label>
                                        <input type="text" name="nameProject" class="form-control" id="name" value="{{ $project->name_project }} required">
                                        <small id="name" class="form-text text-muted">Действительное имя проекта.</small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="controller">Сведения по контроллерам проекта:</label>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="controller" id="controller" rows="5">{{ $project->name_controller }}</textarea>
                                            <small id="controller" class="form-text text-muted">Сведения\IP-адреса\модель.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-3">
                                    <div class="form-group ">
                                        <label for="nameCreate">Разработчик проекта:</label>
                                        <input type="text" name="razrabotchik" class="form-control" id="nameCreate" value="{{ $project->create_project }}">
                                        <small id="nameCreate" class="form-text text-muted">Имя\имена кто писал проект.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Контакты разработчика:</label>
                                        <input type="text" name="tel" class="form-control" id="tel" value="{{ $project->tel_project }}">
                                        <small id="namePosit" class="form-text text-muted">Телефоны.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="map">Местонахождение проекта:</label>
                                        <input type="text" name="map" class="form-control" id="map" value="{{ $project->map_project }}">
                                        <small id="map" class="form-text text-muted">Диск\папка</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="info">Примечание по проекту:</label>
                                        <input type="text" name="info" class="form-control" id="info" value="{{ $project->info_project }}">
                                        <small id="info" class="form-text text-muted">Дополнительные сведения</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2 mr-1 mt-2"></i>Измениь </button>
                            <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('projectwinccs.index') }}">Отмена</a>
                        </form>
                    </div>
                    <hr>

                    <div class="border border-info rounded m-4">
                        <form class="pl-3  pt-3" action="{{ route('projectwincc_linktia') }}" method="POST">

                            @csrf
                            <legend class="pb-3">Привязка контроллера (Спровачник Проекты TIA PORTAL):</legend>
                            <label for="selectDepart">Выбирите котроллер для привязки:</label><br>
                            <div class="btn-group bootstrap-select dropup ">
                                <select class="select-my" aria-label="select depart" id="selectDepart" name="selectTia">
                                    @foreach ($projectTiasSelectInput as $projectTiaSelect)
                                    <option value="{{ $projectTiaSelect->id}}"> ip:{{ $projectTiaSelect->ip }} | Устан-н: {{ mb_strimwidth($projectTiaSelect->room_set, 0, 20, "...")}} | Имя: {{ mb_strimwidth($projectTiaSelect->name, 0, 20, "...")}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pt-3">
                                <label for="info">Дополнительные сведения по привязке:</label>
                                <input type="text" name="info" class="form-control my-size" id="nameDepart" aria-describedby="nameSubDepart" placeholder="Введине сведения">
                                <small id="info" class="form-text text-muted">Ссылочная инфа.</small>
                            </div>

                            <input type="hidden" name="projectWinId" value="{{ $project->id}}">

                            <button type="submit" class="btn btn-primary float-right mr-2 ml-2">Привязать </button>
                            <a class="btn btn-primary float-right ml-2" href="{{ route('projectwinccs.index') }}">Отмена</a>
                        </form>
                    </div>
                    <hr>
                    <div class="row pl-4 pr-4 pt-3">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                @if( count($projectTias))
                                <table class="table table-sm table-responsive-xxl">
                                    <thead>
                                        <tr>
                                            <th colspan="8" class="table-active">Контроллеры проекта <span class="text-primary"><b>{{ $project->name_project }}</b></span></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ip</th>
                                            <th scope="col">Пингануть</th>
                                            <th scope="col">Отделение</th>
                                            <th scope="col">Имя проекта:</th>
                                            <th scope="col">Ссылочная инфа:</th>
                                            <th scope="col"> <acronym title="Кличество WinCC проектов">WinCC<acronym></th>
                                            <th scope="col"> События</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($projectTias as $key=>$projecttia)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><acronym title="Создан: {{ $projecttia->pivot->created_at }}"><a href="http://{{ $projecttia->ip }}">{{ $projecttia->ip }}</a></acronym></td>
                                            <td> <a class=" " href="{{ route('ping_tia', ['id'=>$projecttia->id] ) }}"> ПНУТЬ</a></td>
                                            <td> {{ mb_strimwidth($projecttia->room_set, 0, 30, "...") }}</td>
                                            <td><a class="border_bottom" href="{{ route('projecttias.show', ['projecttia'=>$projecttia->id ] ) }}">{{ mb_strimwidth($projecttia->name, 0, 30, "...") }}</a></td>
                                            <td><acronym title="Инфа: {{ $projecttia->pivot->info_controller }}">{{ mb_strimwidth($projecttia->pivot->info_controller, 0, 30, "...") }}</acronym></td>
                                            <td> {{ $projecttia->projectwinccs()->count() }}</td>
                                            <td>
                                                <form class="mr-3" action="{{ route('projectwincc_deletlinktia', ['tiaid'=>$projecttia->id ] ) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <span style="display: none;"><input type="hidden" name="projectWinID" value="{{ $project->id  }}"></span>
                                                        <button type="submit" class="btn  btn-danger btn-fill nc-icon nc-simple-remove p-2"></button>
                                                        
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <p class="pt-3 pl-4">Cсылок не найдено.</p>
                                        @endforelse
                                    </tbody>
                                </table>

                                <p class="ml-2 pt-2 border-top">Всего: {{ $projectTias->count() }}</p>
                                @else
                                <p class="pt-3 pl-4">Cсылки на контроллеры не найдены.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
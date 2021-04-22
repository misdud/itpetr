@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Редактирование справочников',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'projectTIA'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Справочник:
                            <span class="font-weight-bold"> Проекты TIA Portal</span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668; <a class="border-bottom" href="{{ route('projecttias.index') }}">Проекты TIA Portal</a> &#9658;</p>
                        <p class="card-category pt-3 pl-2"><a class="btn  btn-primary btn-fill  float-right" href="{{ route('projecttias.create') }}"><i class="nc-icon nc-simple-add pr-2 pt-1"></i>{{ __('Добавить') }}</a></p>

                    </div>

                    @if (session('message'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.success')
                    </div>
                    @endif
                    <div class="clearfix">
                        <div class="float-right mr-3 border rounded ">
                            <form class=" col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('projecttia_search' ) }}" method="GET">
                            @csrf
                                <div class="btn-group bootstrap-select dropup p-1">
                                    <input type="search" name="search" class="form-control form-control-dark" placeholder="Поиск по отделению...">
                                </div>
                                <button type="submit" class="btn btn-info pt-2">Найти </button>
                            </form>
                        </div>
                    </div>
                    
                    @if(count($projects)>0)
                    <div class="card-body table-full-width table-responsive pl-4">
                        <p class="ml-2 pb-2 border-bottom">Всего: {{ $projectCount }}</p>
                        <table class="table table-hover table-striped ml-2">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Отделение\помещение &#9660;</th>
                                    <th>НАИМЕНОВАНИЕ ПРОЕКТА</th>
                                    <th>Организация</th>
                                    <th>ФИО разработчика</th>
                                    <th>ip-адрес &#9658; <acronym title="Общая сумма проектов на контроллере">&#8721;</acronym></th>
                                    <th>События</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $project)
                                <tr>
                                    <td>{{ ($projects->currentpage()-1) * $projects->perpage() + $loop->index + 1 }} </td>
                                    <td>{{ mb_strimwidth($project->room_set, 0, 25, "...") }}</td>
                                    <td><acronym title="Изменён: {{ $project->updated_at }}"><a class="bg-success rounded text-secondary p-2" href="{{ route('projecttias.show', ['projecttia'=>$project->id ] ) }}"><i class="nc-icon nc-grid-45  pl-1 pr-1"></i>{{ mb_strimwidth($project->name, 0, 25, "...") }}</a></acronym></td>
                                    <td>{{ mb_strimwidth($project->organization, 0, 20, "...") }}</td>
                                    <td><acronym title="Телефон: {{ $project->tel_dev }}">{{ mb_strimwidth($project->fio_dev, 0, 20, "...") }}</acronym></td>
                                    <td>{{ mb_strimwidth($project->ip, 0, 20, "...") }}  | &#9658; <acronym title="Количество проектов на контроллере">{{ $project->projectwinccs()->count() }}</acronym></td>
                                    <td><a class="btn  btn-warning btn-fill" href="{{ route('projecttias.edit', ['projecttia'=>$project->id ] ) }}"><i class="nc-icon nc-settings-gear-64"></i> Изменить</a></td>
                                </tr>
                                @empty
                                <p>Отделы не найдены</p>
                                @endforelse
                                @else
                                <p class="pl-4">Записей не найдено.</p>
                                @endif
                            </tbody>
                        </table>
                        @if( $projectCount)
                        <p class="ml-2 pt-2 border-top">Отражено: {{ $projects->count() }}</p>
                        @endif
                        <div class="pagination justify-content-center">{{ $projects->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
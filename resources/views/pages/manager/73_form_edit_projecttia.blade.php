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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Изменение записи в справочнике
                            <span class="font-weight-bold"> Проекты TIA Portal </span> &#9658; {{ $project->name }}
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('projecttias.index') }}">Проекты TIA Portal </a> &#9658;</p>
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
                        <form class="float-right mr-3" action="{{ route('projecttias.destroy', ['projecttia'=>$project->id ] ) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn  btn-danger btn-fill nc-icon nc-simple-remove p-2"> Удалить данные проекта <b>{{ $project->name }}</b></button>
                        </form>
                    </div>

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('projecttias.update', ['projecttia'=>$project->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <legend>Заполните поля ниже:</legend>
                            <div class="row border border-success rounded m-1">
                                <div class="col pt-3">
                                    <div class="form-group">
                                        <label for="nameOrg">Организация</label>
                                        <input type="text" name="nameOrganization" class="form-control" id="nameOrg" value="{{ $project->organization }}">
                                        <small id="nameOrg" class="form-text text-muted">Название организации.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Наименование проекта</label>
                                        <input type="text" name="nameProject" class="form-control" id="name" value="{{ $project->name }}">
                                        <small id="name" class="form-text text-muted">Действительное имя TIA Portal проекта.</small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="controller">Краткие сведения по проекту:</label>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="info" id="controller"  rows="5">{{ $project->info }}</textarea>
                                            <small id="controller" class="form-text text-muted">Данные о проекте.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-3">
                                <div class="form-group">
                                        <label for="fio">ФИО разработчика:</label>
                                        <input type="text" name="fio" class="form-control" id="fio" value="{{ $project->fio_dev }}">
                                        <small id="fiot" class="form-text text-muted">ФИО.</small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ip">ip-адрес:</label>
                                        <input type="text" name="ip" class="form-control" id="ip" value="{{ $project->ip }}" size="16" pattern="^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$">
                                        <small id="ip" class="form-text text-muted">ip-v4:172.17.1.1</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Контакты разработчика:</label>
                                        <input type="text" name="tel" class="form-control" id="tel" value="{{ $project->tel_dev }}">
                                        <small id="namePosit" class="form-text text-muted">Номер телефона.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="map">Отделение\помещение:</label>
                                        <input type="text" name="map" class="form-control" id="map" value="{{ $project->room_set }}">
                                        <small id="map" class="form-text text-muted">Отделение\Помещение где установлен</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2 mr-1 mt-2"></i>Измениь </button>
                            <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('projecttias.index') }}">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
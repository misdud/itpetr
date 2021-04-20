@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'roles'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление записи в справочник
                            <span class="font-weight-bold"> Роли </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('roles.index') }}">Роли </a> &#9658;</p>
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

                    <div class="p-4 ">
                    <p class="text-danger">Для  корректной работы сайта необходимо создать следующие роли:</p>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item"><b>admin</b> - Полный доступ</li>
                        <li class="list-group-item"><b>manager_main</b> - Доступ для управляющих</li>
                        <li class="list-group-item"><b>manager</b> - Доступ для начальников</li>
                        <li class="list-group-item"><b>master</b> - Доступ  для мастеров</li>
                        <li class="list-group-item"><b>operator</b> - Доступ  для операторов</li>
                    </ol>
                    </div>

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('roles.store') }}" method="POST">

                            @csrf
                            <legend>Заполните поля ниже:</legend>
                            <div class="form-group">
                                <label for="nameRole">Наименование роли (см. список выше):</label>
                                <input type="text" name="name" class="form-control" id="nameRole" aria-describedby="emailHelp" placeholder="Введине название">
                                <small id="nameRole" class="form-text text-muted">Имя должно быть как в списке.</small>
                            </div>
                            <div class="form-group">
                                <label for="nameInfo">Описание роли:</label>
                                <input type="text" name="infoRole" class="form-control" id="nameInfo" aria-describedby="emailHelp" placeholder="Введине описание">
                                <small id="namePosit" class="form-text text-muted">Описание можно указать как в списке.</small>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2"></i>Сохранить </button>
                            <a class="btn btn-primary float-right ml-2" href="{{ route('roles.index') }}">Отмена</a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
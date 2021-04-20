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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление записи в справочник
                            <span class="font-weight-bold"> Проекты WinCC</span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('projectwinccs.index') }}">Проекты WiCC</a> &#9658;</p>
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

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('projectwinccs.store') }}" method="POST">

                            @csrf
                            <legend>Заполните поля ниже:</legend>
                            <div class="row border border-info rounded m-1">
                                <div class="col pt-3">
                                    <div class="form-group">
                                        <label for="nameOtdel">Отделение</label>
                                        <input type="text" name="nameOtdel" class="form-control" id="nameOtdel" placeholder="Введите название отделения">
                                        <small id="name" class="form-text text-muted">Отделение где используется проект.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Наименование проекта</label>
                                        <input type="text" name="nameProject" class="form-control" id="name" placeholder="Введите название">
                                        <small id="name" class="form-text text-muted">Действительное имя проекта.</small>
                                    </div>
                                    <div class="form-group ">
                                        <label for="controller">Краткие сведения по контроллерам проекта:</label>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="controller" id="controller" placeholder="Введите ..." rows="5"></textarea>
                                            <small id="controller" class="form-text text-muted">IP-адреса\Данные для проекта.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-3">
                                    <div class="form-group ">
                                        <label for="nameCreate">Разработчик проекта:</label>
                                        <input type="text" name="razrabotchik" class="form-control" id="nameCreate" placeholder="Введите имя разработчика">
                                        <small id="nameCreate" class="form-text text-muted">Имя\имена кто писал  проект.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Контакты разработчика:</label>
                                        <input type="text" name="tel" class="form-control" id="tel" placeholder="Введите ном.тел.">
                                        <small id="namePosit" class="form-text text-muted">Телефоны.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="map">Местонахождение проекта:</label>
                                        <input type="text" name="map" class="form-control" id="map" placeholder="Введите где находится проект">
                                        <small id="map" class="form-text text-muted">Диск\папка</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="info">Примечание по проекту:</label>
                                        <input type="text" name="info" class="form-control" id="info" placeholder="Введите доп. сведения">
                                        <small id="info" class="form-text text-muted">Дополнительные сведения</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2 mr-1 mt-2"></i>Создать</button>
                            <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('projectwinccs.index') }}">Отмена</a>
                            <p class="pl-2 text-warning">После создания можно добавить котроллеры из справочника <b>Проекты TIA Portal.</b></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'departs'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление записи в справочник
                            <span class="font-weight-bold"> Отделы </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('main_catalogs') }}">Отделы </a> &#9658;</p>
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
                        <div class="border rounded ml-2">
                            <form class="pl-3  pt-3" action="{{ route('departments.store') }}" method="POST">

                                @csrf
                                <legend>Заполните поля ниже:</legend>
                                <div class="form-group">
                                    <label for="nameDepart">Наименование отдела:</label>
                                    <input type="text" name="name" class="form-control my-size" id="nameDepart" aria-describedby="emailHelp" placeholder="Введине название">
                                    <small id="emailHelp" class="form-text text-muted">Имя должно быть уникальным.</small>
                                </div>
                                <div class="form-group">
                                    <label for="priori_dep">Условный приоритет</label>
                                    <input type="text" name="numPriori" value="{{ $priori }}" class="form-control my-size" id="priori_dep" readonly="readonly">
                                </div>
                                <button type="submit" class="btn btn-primary float-right ml-2 mt-2"></i>Сохранить </button>
                                <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('main_catalogs') }}">Отмена</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
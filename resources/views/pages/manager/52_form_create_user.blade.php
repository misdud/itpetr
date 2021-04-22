@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'users'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление записи в справочник
                            <span class="font-weight-bold"> Сотрудники </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('users.index') }}">Сотрудники </a> &#9658;</p>
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
                            <form class="pl-3  pt-3" action="{{ route('user_deprt') }}" method="GET">
                                @method('GET')
                                @csrf
                                <legend>Заполните поля ниже:</legend>
                                <label for="selectDepart">Выбирите отдел сотрудника:</label><br>
                                <div class="btn-group bootstrap-select dropup ">
                                    <select class="select-my" aria-label="select depart" id="selectDepart" name="selectDepart">
                                        @foreach ($departs as $depart)
                                        <option value="{{ $depart->id }}">{{ $depart->name_depart }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group pt-3 my-size">
                                    <label for="nameUsr">ФИО сотрудника:</label>
                                    <input type="text" name="name" class="form-control my-size" id="nameUsr" placeholder="Введите фио">
                                    <small id="nameUsr" class="form-text text-muted">Н-р: Иванов Иван Иванович.</small>
                                </div>

                                <div class="form-group my-sizelogin">
                                    <label for="login">Табельный номер:</label>
                                    <input type="text" name="login" class="form-control" id="login" placeholder="Введите номер">
                                    <small id="login" class="form-text text-muted">Дейст-ный таб. номер.</small>
                                </div>

                                <button type="submit" class="btn btn-primary float-right ml-2 mt-2"></i>Далее </button>
                                <a class="btn btn-warning float-right ml-2 mt-2" href="{{ route('users.index') }}">Отмена</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
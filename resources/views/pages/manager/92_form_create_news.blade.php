@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for list --}}
                    @include('pages.manager.links_news', ['test'=>'news'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление новости
                            <span class="font-weight-bold"> Общие </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с &#9668;<a class="border-bottom" href="{{ route('news.index') }}">Новостями</a> &#9658;</p>
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
                            <form class="pl-3  pt-3" action="{{ route('news.store') }}" method="POST">

                                @csrf
                                <legend>Заполните поля ниже:</legend>
                                <div class="form-group">
                                    <label for="post">Тема:</label>
                                    <input type="text" name="post" class="form-control my-size" id="post" required placeholder="Введине название">
                                    <small id="post" class="form-text text-muted">Кратко</small>
                                </div>
                                <div class="form-group">
                                    <label for="user">Автор:</label>
                                    <input type="text" name="user" value="{{ $user->fio_full }}" class="form-control my-size" id="user" readonly="readonly">
                                </div>
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                <div class="form-group mr-3">
                                    <label for="info">Контекст новости:</label>
                                    <div class="mb-3">
                                        <textarea class="form-control" name="info" id="controller" required placeholder="Введите ..." rows="5"></textarea>
                                        <small id="info" class="form-text text-muted">Все сведения.</small>
                                    </div>
                                </div>
                                <div class="ml-2 mb-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="activ" value='1' id="flexRadioDefault1">
                                        <label class="form-text text-muted pt-1 " for="flexRadioDefault1">
                                            Включить (для показа)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activ" value='0' id="flexRadioDefault2" checked>
                                        <label class="form-text text-muted pt-1 " for="flexRadioDefault2">
                                            Отключить (для показа)
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right ml-2 mt-2"></i>Сохранить </button>
                                <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('news.index') }}">Отмена</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
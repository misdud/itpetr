@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'positions'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Изменение записи в справочнике
                            <span class="font-weight-bold"> Должности </span> &#9658; {{ $dataPosition->name_position }}
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('positions.index') }}">Должности </a> &#9658;</p>
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
                    <form class="pl-3  pt-3" action="{{ route('positions.update',  ['position'=>$dataPosition->id ] ) }}" method='POST'>
                            @csrf
                            @method('PUT')
                            <legend>Заполните поле ниже:</legend>
                            <div class="form-group">
                                <label for="nameDepart">Наименование должности: </label>
                                <input type="text" name="name" class="form-control" id="nameDepart" aria-describedby="nameHelp" value="{{ $dataPosition->name_position }}">
                                <small id="nameHelp" class="form-text text-muted">Имя должно быть уникальным (текущее: <span class="badge bg-warning text-wrap p-1 ml-1">  {{ $dataPosition->name_position }} </span>).</small>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2">Изменить </button>
                            <a class="btn btn-primary float-right ml-2" href="{{ route('positions.index') }}">Отмена</a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
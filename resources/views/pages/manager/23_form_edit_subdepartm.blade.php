@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'subdeprts'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Изменение записи в справочнике
                            <span class="font-weight-bold"> Подразделения </span> &#9658; {{ $dataSubDepart->name_subdepart }}
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668;<a class="border-bottom" href="{{ route('sub_departments.index') }}">Подразделения </a> &#9658;</p>
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

                    @if (session('msgIdentical'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.identical')
                    </div>
                    @endif

                    <div class="card-body table-full-width table-responsive pl-4">
                        <div class="border rounded ml-2">
                            <form class="pl-3  pt-3" action="{{ route('sub_departments.update',  ['sub_department'=>$dataSubDepart->id ] ) }}" method='POST'>
                                @csrf
                                @method('PUT')
                                <legend class="pb-3">Заполните поля ниже:</legend>
                                <label for="selectDepart">Выбирите отдел для подразделения:</label><br>
                                <div class="btn-group bootstrap-select dropup ">
                                    <select class="select-my" aria-label="select depart" id="selectDepart" name="selectDepart">
                                        @foreach ($departs as $depart)
                                        <option value="{{ $depart->id }}" @if ($depart->id == $dataSubDepart->department->id)
                                            selected="selected" @endif> {{ $depart->name_depart }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <small id="selectDepart" class="form-text text-muted">Текущий отдел: <span class="badge bg-warning text-wrap p-1 ml-1">{{ $dataSubDepart->department->name_depart }} </span></small>
                                </div>

                                <div class="form-group pt-3">
                                    <label for="nameSubDepart">Наименование отдела: </label>
                                    <input type="text" name="name" class="form-control my-size" id="nameSubDepart" aria-describedby="nameHelp" value="{{ $dataSubDepart->name_subdepart }}">
                                    <small id="nameHelp" class="form-text text-muted">Имя должно быть уникальным (текущее: <span class="badge bg-warning text-wrap font-monospace p-1 ml-1"> {{ $dataSubDepart->name_subdepart }}</span>).</small>
                                </div>
                                <div class="form-group">
                                    <label for="priori_sdep">Приоритет: </label>
                                    <input type="text" name="numPriori" value="{{ $dataSubDepart->priori_sub }}" class="form-control my-size" id="priori_sdep">
                                    <small id="nameHelp" class="form-text text-muted">Приоритет отображения в списках (текущий:<span class="badge bg-warning text-wrap  pt-1 ml-1"> {{ $dataSubDepart->priori_sub }}</span>)</small>
                                </div>
                                <input type="hidden" name="oldDepart" value={{ $dataSubDepart->department->id }}></p>
                                <button type="submit" class="btn btn-primary float-right ml-2 mt-2">Изменить </button>
                                <a class="btn btn-primary float-right ml-2 mt-2" href="{{ route('sub_departments.index') }}">Отмена</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Добавление записи в справочник
                            <span class="font-weight-bold"> Подразделения</span>
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

                    @if($countDepart > 0)

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('sub_departments.store') }}" method="POST">

                            @csrf
                            <legend class="pb-3">Заполните поля ниже:</legend>
                                <label for="selectDepart">Выбирите отдел для подразделения:</label><br>
                                <div class="btn-group bootstrap-select dropup ">
                                <select class="select-my" aria-label="select depart" id="selectDepart" name="selectDepart">
                                    @foreach ($departs as $depart)
                                    <option value="{{ $depart->id }}" @if ($depart->id == old('selectDepart', $depart->name_depart))
                                        selected="selected" @endif>{{ $depart->name_depart }}</option>
                                    @endforeach
                                </select>
                                </div>
                          
                            <div class="form-group pt-3">
                                <label for="nameSubDepart">Наименование подразделения:</label>
                                <input type="text" name="name" class="form-control" id="nameDepart" aria-describedby="nameSubDepart" placeholder="Введине название">
                                <small id="nameSubDepart" class="form-text text-muted">Наименование подразделения должно быть уникальным.</small>
                            </div>
                            <div class="form-group">
                                <label for="SubDepPri">Условный приоритет</label>
                                <input type="text" name="numPriori" value="{{ $priori_subdep }}" class="form-control" id="SubDepPrip">
                                <small id="SubDepPri" class="form-text text-muted">Приоритет отображения в списках</small>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2">Сохранить </button>
                            <a class="btn btn-primary float-right ml-2" href="{{ route('sub_departments.index') }}">Отмена</a> 
                        </form>
                    </div>

                    @else
                    <p class="ml-3 mt-2 pt-5 ">Для добавления записи необходимо содать запись в справочнике &#9668; <a class="border-bottom" href="{{ route('main_catalogs') }}">Отделы </a> &#9658;</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
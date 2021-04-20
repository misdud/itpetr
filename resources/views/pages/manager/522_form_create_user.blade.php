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
                            <span class="font-weight-bold"> Сотрудники </span>  &#9658; {{ $nameFio }}
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
                        <form class="pl-3  pt-3" action="{{ route('users.store') }}" method="POST">
                         @csrf
                           <div class="pb-3 pl-3 pt-3 border border-secondary rounded">
                            <label for="nameUsr">ФИО сотрудника:</label>
                            <input class="form-control my-size"  type="text" name ='name' value="{{ $nameFio }}" readonly id="nameUsr"> 
                            <label for="loginUsr">Табельный номер:</label>
                            <input class="form-control my-sizelogin"  type="text" name = 'login' value= {{ $login }}   readonly id="loginUsr">
                            <label for="departUsr">Выбранный отдел:</label>
                            <input class="form-control my-size"  type="text" name = 'depart' value= {{ $depart->name_depart }} readonly id="departUsr">
                            <input  type="hidden" name = 'departId' value= {{ $depart->id }}>
                            </div>
                            <hr>

                            <div class="row pt-3">
                                <div class="col  border border-secondary rounded m-1 ml-3 pt-2">
                                    <legend>Укажите подразделение и должность:</legend>
                                    <label for="selectSubDepart">Выбирите подразделение из отдела <b>{{ $depart->name_depart }}</b>  для сотрудника:</label><br>
                                    <div class="btn-group bootstrap-select dropup  pb-3">
                                        <select class="select-my" aria-label="select depart" id="selectSubDepart" name="selectSubDepart">
                                            @foreach ($subdeparts as $subdepart)
                                            <option value="{{ $subdepart->id }}">{{ $subdepart->name_subdepart }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <label for="selectPosit">Выбирите  <b>должность </b>  для сотрудника:</label><br>
                                    <div class="btn-group bootstrap-select dropup ">
                                        <select class="select-my" aria-label="select depart" id="selectPosit" name="selectPosition">
                                            @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name_position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col pb-3">
                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 bg-info ">
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="activ" value ='1' id="flexRadioDefault1">
                                                <label class="form-text text-muted pt-1 " for="flexRadioDefault1">
                                                    Включён
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="activ" value ='0' id="flexRadioDefault2" checked>
                                                <label class="form-text text-muted pt-1 " for="flexRadioDefault2">
                                                    Отключён
                                                </label>
                                            </div>
                                        </div>    
                               
                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="itr" value ='1' id="flexRadioDefault11">
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault11">
                                                ИТР работник
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="itr" value ='0' id="flexRadioDefault22" checked>
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault22">
                                                не ИТР работник
                                            </label>
                                        </div>
                                    </div>
                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="show_manager" value ='1' id="flexRadioDefault111">
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault111">
                                            Показывать в списке управленцев
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="show_manager" value ='0' id="flexRadioDefault222" checked>
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault222">
                                                Не показывать в списке управленцев
                                            </label>
                                        </div>
                                    </div>    
                                </div>
                            </div>       

                            <div class="row pt-3">
                                <div class="col  border border-secondary rounded m-1 ml-3 pt-2">
                                        <div class="form-group my-size pt-3">
                                            <label for="tel_belki">Внутренний телефон:</label>
                                            <input type="text" name="tel_belki" class="form-control" id="tel_belki" placeholder="Введите телефон">
                                            <small id="tel_belki" class="form-text text-muted">Н-р: 00-88.</small>
                                        </div>

                                        <div class="form-group my-size pt-1">
                                            <label for="tel_mob">Мобильный телефон:</label>
                                            <input type="text" name="tel_mob" class="form-control" id="tel_mob" placeholder="Введите телефон">
                                            <small id="tel_mob" class="form-text text-muted">Н-р: 8029-604-93-96.</small>
                                        </div>

                                        <div class="form-group my-size">
                                            <label for="room">Кабинет:</label>
                                            <input type="text" name="room" class="form-control" id="room" placeholder="Введите расположение кабинета">
                                            <small id="room" class="form-text text-muted">Н-р: АБК РУ каб.3040</small>
                                        </div>
                                </div>

                                <div class="col  border border-secondary rounded m-1  pt-2 ">
  
                                        <div class="form-group my-size">
                                            <label for="dr">Дата рождения:</label>
                                            <input type="date" name="dr" class="form-control" id="dr" placeholder="Введите дату рождения">
                                            <small id="dr" class="form-text text-muted">Можно не указывать (п\у: 2021-01-01)</small>
                                        </div>

                                        <div class="form-group my-size">
                                            <label for="prioritet">Приоритет отражения в списках:</label>
                                            <input type="number" name="prioritet" class="form-control" id="prioritet" placeholder="Введите расположение кабинета">
                                            <small id="prioritet" class="form-text text-muted">Н-р: 1 (1 - для руководит, 2 - нач., 3 - мастер, п\у 1000)</small>
                                        </div>
                                        <div class="form-group my-size">
                                            <label for="passwd">Пароль:</label>
                                            <input type="password" name="pasword" class="form-control" id="passwd"  placeholder="Введите пароль">
                                            <small id="passwd" class="form-text text-muted">Мин. 6 сим.  </small>
                                         </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-2">
                                    <button type="submit" class="btn btn-primary float-right ml-2"></i>Сохранить </button>
                                    <a class="btn btn-secondary  float-right ml-2" href="{{ route('users.create') }}">Назад</a>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
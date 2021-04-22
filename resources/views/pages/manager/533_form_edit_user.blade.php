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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Изменение записи в справочнике
                            <span class="font-weight-bold"> Сотрудники </span> &#9658; {{ $user->fio_full }}
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

                    @if (session('message_info'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.info')
                    </div>
                    @endif

                    <form class="pl-3  pt-3" action="{{ route('users.destroy', ['user'=>$user->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger float-right  float-right mr-3">Удалить сотрудника</button>
                    </form>

                    <div class="card-body table-full-width table-responsive pl-4">
                        <form class="pl-3  pt-3" action="{{ route('users.update', ['user'=>$user->id])  }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="pb-3 pl-3 pt-3 border border-secondary rounded">
                                <label for="nameUsr">ФИО сотрудника:</label>
                                <input class="form-control my-size" type="text" name='name' value="{{ $user->fio_full }}" readonly id="nameUsr">
                                <label for="loginUsr">Табельный номер:</label>
                                <input class="form-control my-sizelogin" type="text" name='login' value="{{ $user->login }}" readonly id="loginUsr">
                                <label for="departUsr">Выбранный отдел:</label>
                                <input class="form-control my-size @if($depart->name_depart != $user->department->name_depart) text-warning h6 @endif" type="text" name='depart' value="{{ $depart->name_depart }}" readonly id="departUsr">
                                <input type="hidden" name='departId' value={{ $depart->id }}>
                            </div>
                            <hr>

                            <div class="row pt-3">
                                <div class="col  border border-secondary rounded mt-1 ml-3 pt-2">
                                    <legend>Укажите подразделение и должность:</legend>
                                    <label for="selectSubDepart">Выбирите подразделение из отдела <b>{{ $depart->name_depart }}</b> для сотрудника:</label><br>
                                    <div class="btn-group bootstrap-select dropup">
                                        <select class="select-my" aria-label="select depart" id="selectSubDepart" name="selectSubDepart">
                                            @foreach ($subdeparts as $subdepart)
                                            <option value="{{ $subdepart->id }}" @if ($subdepart->id == $user->subdepartment->id)
                                                selected="selected" @endif> {{ $subdepart->name_subdepart }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small id="selectSubDepart" class="form-text text-muted">Текущее:<span class="badge bg-warning text-wrap  pt-1 ml-1"> {{ $user->department->name_depart }} \ {{ $user->subdepartment->name_subdepart }}</span></small>

                                    <br>
                                    <label for="selectSubDepart">Выбирите <b>должность </b> для сотрудника:</label><br>
                                    <div class="btn-group bootstrap-select dropup ">
                                        <select class="select-my" aria-label="select depart" id="selectPosit" name="selectPosition">
                                            @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" @if($position->id == $user->position->id)
                                                selected = "selected" @endif> {{ $position->name_position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small id="selectSubDepart" class="form-text text-muted pb-2">Текущая:<span class="badge bg-warning text-wrap  pt-1 ml-1"> {{ $user->position->name_position }}</span></small>

                                </div>
                                <div class="col pb-3">
                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 bg-info ">
                                        <div class="form-check ">
                                            <input class="form-check-input" type="radio" name="activ" value='1' @if($user->activ) checked @endif id="flexRadioDefault1">
                                            <label class="form-text text-muted pt-1 " for="flexRadioDefault1">
                                                Включён
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="activ" value='0' @if(!($user->activ)) checked @endif id="flexRadioDefault2" >
                                            <label class="form-text text-muted pt-1 " for="flexRadioDefault2">
                                                Отключён
                                            </label>
                                        </div>
                                    </div>

                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="itr" value='1' @if($user->itr) checked @endif id="flexRadioDefault11">
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault11">
                                                ИТР работник
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="itr" value='0' @if(!($user->itr)) checked @endif id="flexRadioDefault22" >
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault22">
                                                не ИТР работник
                                            </label>
                                        </div>
                                    </div>
                                    <div class="border border-secondary rounded m-1  pl-3 pt-2 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="show_manager" value='1' @if($user->show_manager) checked @endif id="flexRadioDefault111">
                                            <label class="form-text text-muted pt-1" for="flexRadioDefault111">
                                                Показывать в списке управленцев
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="show_manager" value='0' @if(!($user->show_manager)) checked @endif id="flexRadioDefault222">
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
                                        <input type="text" name="tel_belki" class="form-control" id="tel_belki" value="{{ $user->tel_belki }}">
                                        <small id="tel_belki" class="form-text text-muted">Н-р: 00-88.</small>
                                    </div>

                                    <div class="form-group my-size pt-1">
                                        <label for="tel_mob">Мобильный телефон:</label>
                                        <input type="text" name="tel_mob" class="form-control" id="tel_mob" value="{{ $user->tel_mob }}">
                                        <small id="tel_mob" class="form-text text-muted">Н-р: 8029-604-93-96.</small>
                                    </div>

                                    <div class="form-group my-size">
                                        <label for="room">Кабинет:</label>
                                        <input type="text" name="room" class="form-control" id="room" value="{{ $user->room }}">
                                        <small id="room" class="form-text text-muted">Н-р: АБК РУ каб.3040</small>
                                    </div>
                                </div>

                                <div class="col  border border-secondary rounded m-1  pt-2 mr-3 ">
                                    <div class="form-group my-size">
                                        <label for="dr">Дата рождения:</label>
                                        <input type="date" name="dr" class="form-control" id="dr" value="{{ $user->dr }}">
                                        <small id="dr" class="form-text text-muted">Можно не указывать (п\у: 2021-01-01)</small>
                                    </div>

                                    <div class="form-group my-size">
                                        <label for="prioritet">Приоритет отражения в списках:</label>
                                        <input type="number" name="prioritet" min="0" max="10001" class="form-control" id="prioritet" value="{{ $user->prioritet }}">
                                        <small id="prioritet" class="form-text text-muted">Н-р: 1 (1 - для руководит, 2 - нач., 3 - мастер, п\у 1000)</small>
                                    </div>
                                    <div class="form-group my-size">
                                        <label for="dat">Дата изменения:</label>
                                        <input type="text" name="dat" class="form-control" id="dat" value="{{ date('d-m-Y H:i:s', strtotime($user->updated_at)) }}" readonly>
                                        <small id="prioritet" class="form-text text-muted">Если изменений не было, то указана дата создания.</small>
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
                        <hr class="ml-3">
                        {{-- reset password and roles --}}
                        <div class="row pt-2 pb-2">
                            <div class="col ml-3">
                                <div class="p-2 pr-4 pl-4 border border-danger rounded">
                                    <form class="" action="{{ route('user_setrole', ['user'=>$user->id]) }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <legend>Укажите роль для сотрудника:</legend>
                                            <label for="selectSubDepart">Выберите роль:</label><br>
                                            <div class="btn-group bootstrap-select dropup">
                                                <select class="select-my" aria-label="select depart" id="selectSubDepart" name="selectRole">
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-warning  pl-2 mt-1">Задать роль</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    @forelse( $rolesUsers as $role)
                                    <form action="{{ route('user_deletrole', ['user'=>$user->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="roleId" value="{{ $role->id }}">
                                        <button type="submit" class="btn btn-success float-left mr-1">{{ $role->role_name  }}<i class="nc-icon nc-simple-remove pl-1 pr-1"></i></button>
                                    </form>
                                    @empty
                                    <p class="pt-3 pl-4">Роль не назначена.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-1 pr-4 pl-4 border border-info rounded">
                                    <form сlass="" action="{{ route('user_resetpaswd') }}" method="POST">
                                        @csrf
                                        <div class="form-group ">
                                            <legend>Смена пароля:</legend>
                                            <label for="passwd">Новый пароль:</label>
                                            <input type="password" name="pasword" class="form-control my-size" id="passwd" placeholder="Введите пароль">
                                            <small id="passwd" class="form-text text-muted">Мин. 6 сим. </small>
                                            {{-- User !!!!!!!! --}} <input type="hidden" id="usr" name="userId" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-warning  mt-3">Сменить пароль</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Редактирование справочников',
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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Справочник:
                            <span class="font-weight-bold"> Сотрудники </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668; <a class="border-bottom" href="{{ route('users.index') }}">Сотрудники </a> &#9658;</p>
                        <p class="card-category pt-3 pl-2"><a class="btn  btn-primary btn-fill  float-right" href="{{ route('users.create') }}"><i class="nc-icon nc-simple-add pr-2 pt-1"></i>{{ __('Добавить') }}</a></p>

                    </div>
                    <div class="clearfix">
                        <div class="float-right mr-3 border rounded ">
                            <form class=" col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('user_search' ) }}" method="GET">
                                @csrf

                                <div class="btn-group bootstrap-select dropup p-1">
                                  <input type="search" name="search" class="form-control form-control-dark" placeholder="Поиск по фио...">
                                </div>
                                <button type="submit" class="btn btn-info pt-2">Найти </button>
                            </form>
                        </div>
                    </div>
                    {{-- для сообщения по созданному сотруднику  --}}
                    @if (session('message'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.success')
                    </div>
                    @endif

                    @if(count($users)>0)
                    <div class="card-body table-full-width table-responsive pl-4">
                        <p class="ml-2 pb-2 border-bottom">Всего: {{ $userCount }} (<span class="nc-icon nc-single-02"></span> <i> - ИТР</i>, <span class="nc-icon nc-circle-09 text-primary"></span> <i>- в списке руков.</i>)</p>
                        <table class="table table-hover table-striped ml-2">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>ФИО &#9660;</th>
                                    <th>Табельный</th>
                                    <th>Отдел</th>
                                    <th>Подразделение</th>
                                    <th>Внутр.тел.</th>
                                    <th>Должность</th>
                                    <th>События</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1 }}</td>

                                    @if($user->itr)
                                    <td> <i class="nc-icon nc-single-02"></i> <b>{{ $user->fio_full }}</b></td>
                                    @else
                                    <td>{{ $user->fio_full }}</td>
                                    @endif

                                    @if($user->show_manager)
                                    <td><i class=" nc-icon nc-circle-09 text-primary"></i> <span class="text-secondary h6"><acronym title="Создана запись о сотруднике: {{ date('d-m-Y H:i', strtotime($user->created_at)) }}">{{ $user->login }}</acronym></span></td>
                                    @else
                                    <td><acronym title="Создана запись о сотруднике: {{ date('d-m-Y H:i', strtotime($user->created_at)) }}">{{ $user->login }}</acronym></td>
                                    @endif

                                    <td>{{ $user->department->name_depart }}</td>
                                    <td>{{ $user->subdepartment->name_subdepart }}</td>
                                    <td><acronym title="Мобильный: {{ $user->tel_mob }}">{{ $user->tel_belki }}</acronym></td>
                                    <td>{{ $user->position->name_position}}</td>
                                    @if($user->activ)
                                    <td><a class="btn-sm  btn-info btn-fill" href="{{ route('user_editdep', [ 'depatr'=>$user->department->id, 'user'=>$user->id ] ) }}"><i class="nc-icon nc-settings-tool-66"></i> {{ __('Редакт-ть') }}</a></td>
                                    @else
                                    <td><a class="btn-sm btn-warning btn-fill" href="{{ route('user_editdep', ['depatr'=>$user->department->id, 'user'=>$user->id ] ) }}"><i class="nc-icon nc-button-power"></i> {{ __('Включить') }}</a></td>
                                    @endif
                                </tr>
                                @empty
                                <p>Не найдены</p>
                                @endforelse
                                @else
                                <p class="pl-4">Справочник пуст, записей не найдено.</p>
                                @endif
                            </tbody>
                        </table>
                        @if( $userCount)
                        <p class="ml-2 pt-2 border-top">Отражено: {{ $users->count() }}</p>
                        @endif
                        <div class="pagination justify-content-center">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
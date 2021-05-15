@extends('layouts.app_pages', ['activePage' => 'managers', 'title' => 'Руководители', 'navName' => 'Руководители', 'activeButton' => 'managers'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">
                    {{-- insert lins for busschedule  --}}
                    @include('list_managers.list_manager', ['num'=>'rudoupr'])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="float-left">
                            <h4 class="card-title">{{ $depart->name_depart  ?? 'Поиск:'}}</h4>
                            <p class="card-category">Список руководителей</p>
                        </div>
                        <div class="float-right mr-3 border rounded ">
                            <form class="mb-3 mb-lg-0 ml-lg-3" action="{{ route('manager_search' ) }}" method="GET">
                                @csrf
                                <div class="btn-group bootstrap-select dropup p-1">
                                    <input type="search" name="search" class="form-control form-control-dark"  value="{{ request()->input('search') ?? old('search')}}" placeholder="Поиск по фио...">
                                </div>
                                <button type="submit" class="btn btn-info mr-1 ml-1 p-2"> Найти </button>
                            </form>
                        </div>

                    </div>
                    <div class="card-body  table-full-width table-responsive ml-1 mr-1">
                        <table class="table    table-borderless table-hover table-striped mt-3">
                            @if($userManagers->count() > 0)
                            <thead>
                                <th>№</th>
                                <th>Фото</th>
                                <th>ФИО</th>
                                <th>Должность</th>
                                <th>Место работы</th>
                                <th>Телефон</th>
                                <th>Кабинет</th>
                                <th style="color:white; opacity: .3;">p 1-100</th>
                            </thead>
                            @endif
                            <tbody>
                                @forelse($userManagers as $key=>$userManager)
                                <tr>
                                    <td>{{ $key + 1  }}</td>
                                    @if(file_exists( public_path().'/light-bootstrap/img/faces/'.$userManager->login.'.jpg' ))
                                    <td><img src="{{ asset('/light-bootstrap/img/faces/'.$userManager->login.'.jpg') }}" class="img-fluid  rounded p-0 m-0" width="35" alt="foto_"></td>
                                    @else
                                    <td style="color:white; opacity: .15;"><img src="{{ asset('light-bootstrap/img/faces/default-avatar.jpg') }}" class="img-fluid  rounded" width="35" alt="foto"></td>
                                    @endif

                                    {{-- для первого выделять имя--}}
                                    @if($key == 0 )
                                    <td><b>{{ $userManager->fio_full }}</b></td>
                                    @else
                                    <td>{{ $userManager->fio_full }}</td>
                                    @endif

                                    {{-- для первого выделять должность --}}
                                    @if($key == 0 )
                                    <td><b>{{ $userManager->position->name_position }}</b></td>
                                    @else
                                    <td>{{ $userManager->position->name_position}}</td>
                                    @endif

                                    <td>Петриков &bull; {{ $userManager->department->name_depart }}</td>
                                    <td>{{ $userManager->tel_belki }}</td>
                                    <td>{{ $userManager->room }}</td>
                                    <td style="color:#F2F2F2; opacity: .3;">{{ $userManager->prioritet }}</td>
                                </tr>
                                @empty
                                <p class="pl-4">Записей не найдено.</p>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
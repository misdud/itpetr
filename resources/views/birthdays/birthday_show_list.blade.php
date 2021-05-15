@extends('layouts.app_pages', ['activePage' => 'birthday', 'title' => 'Именинники', 'navName' => 'Именинники', 'activeButton' => 'birthday'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">
                    {{-- insert lins for birthday  --}}
                    @include('birthdays.list_birthday')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="float-left">
                            <h4 class="card-title"> Именинники </h4>
                            <p class="card-category">Список  именинников: {{ $date }}</p>
                        </div>
                        {{--
                        <div class="float-right mr-3 border rounded ">
                            <form class="mb-3 mb-lg-0 ml-lg-3" action="{{ route('manager_search' ) }}" method="GET">
                                @csrf
                                <div class="btn-group bootstrap-select dropup p-1">
                                    <input type="search" name="search" class="form-control form-control-dark" value="{{ request()->input('search') ?? old('search')}}" placeholder="Поиск по фио...">
                                </div>
                                <button type="submit" class="btn btn-info mr-1 ml-1 p-2"> Найти </button>
                            </form>
                        </div>
                        --}}
                    </div>
                    <div class="card-body  table-full-width table-responsive ml-1 mr-1">
                        <table class="table    table-borderless table-hover table-striped mt-3">
                            @if($users->count() > 0)
                            <thead>
                                <th>№</th>
                                <th>Фото</th>
                                <th>ФИО</th>
                                <th>День рождения</th>
                                <th>Место работы</th>
                                <th>Должность</th>
                                <th>Телефон</th>
                                <th>Кабинет</th>

                            </thead>
                            @endif
                            <tbody>
                                @forelse($users as $key=>$user)
                                <tr>
                                    <td>{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1 }}</td>
                                    @if(file_exists( public_path().'/light-bootstrap/img/faces/'.$user->login.'.jpg' ))
                                    <td><img src="{{ asset('/light-bootstrap/img/faces/'.$user->login.'.jpg') }}" class="img-fluid  rounded p-0 m-0" width="35" alt="foto_"></td>
                                    @else
                                    <td style="color:white; opacity: .15;"><img src="{{ asset('light-bootstrap/img/faces/default-avatar.jpg') }}" class="img-fluid  rounded" width="35" alt="foto"></td>
                                    @endif

                                    <td>{{ $user->fio_full }}</td>
                                    <td>{{ date('d-m', strtotime($user->dr)) }} </td>
                                    <td>Петриков &bull; {{ $user->department->name_depart }}</td>
                                    <td>{{ $user->position->name_position}}</td>
                                    <td>{{ $user->tel_belki }}</td>
                                    <td>{{ $user->room }}</td>

                                </tr>
                                @empty
                                <p class="pl-4">Именинников не найдено.</p>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
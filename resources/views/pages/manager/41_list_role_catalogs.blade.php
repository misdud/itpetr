@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Редактирование справочников',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog  --}}
                    @include('pages.manager.links', ['test'=>'roles'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Справочник:
                            <span class="font-weight-bold"> Роли </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668; <a class="border-bottom" href="{{ route('roles.index') }}">Роли </a> &#9658;</p>
                        <p class="card-category pt-3 pl-2"><a class="btn  btn-primary btn-fill  float-right" href="{{ route('roles.create') }}"><i class="nc-icon nc-simple-add pr-2 pt-1"></i>{{ __('Добавить') }}</a></p>

                    </div>
                    @if(count($roles)>0)
                    <div class="card-body table-full-width table-responsive pl-4">
                        <p class="ml-2 pb-2 border-bottom">Всего: {{ $rolesCount }}</p>
                        <table class="table table-hover table-striped ml-2">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Наименование</th>
                                    <th>Описание</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>События</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>{{  ($roles->currentpage()-1) * $roles->perpage() + $loop->index + 1 }}</td>
                                    <td><b>{{ $role->role_name }}</b></td>
                                    <td>{{ $role->role_info }}</td>
                                    <td>{{ date('d-m-Y H:i:s',strtotime($role->created_at)) }}</td>
                                    <td>
                                    @if($role->created_at !=  $role->updated_at)
                                       <span style="color:#852A00">{{ date('d-m-Y H:i:s',strtotime($role->updated_at)) }}</span>
                                    @else
                                       {{ date('d-m-Y H:i:s',strtotime($role->updated_at)) }}
                                    @endif
                                    </td>
                                    <td><a class="btn-sm  btn-warning btn-fill" href="{{ route('roles.edit', ['role'=>$role->id ] ) }}"><i class="nc-icon nc-settings-tool-66"></i> {{ __('Изменить') }}</a></td>
                                </tr>
                                @empty
                                <p>Отделы не найдены</p>
                                @endforelse
                                @else
                                <p class="pl-4">Справочник пуст, записей не найдено.</p>
                                @endif
                            </tbody>
                        </table>
                        @if( $rolesCount)
                            <p class="ml-2 pt-2 border-top">Отражено: {{ $roles->count() }}</p>
                        @endif                       
                        <div class="pagination justify-content-center">{{ $roles->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
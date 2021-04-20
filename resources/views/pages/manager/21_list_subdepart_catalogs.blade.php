@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Редактирование справочников',
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
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Справочник:
                            <span class="font-weight-bold"> Подразделения </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с справочником &#9668; <a class="border-bottom" href="{{ route('sub_departments.index') }}">Подразделения</a> &#9658;</p>
                        <p class="card-category pt-3 pl-2"><a class="btn  btn-primary btn-fill  float-right mr-3" href="{{ route('sub_departments.create') }}"><i class="nc-icon nc-simple-add pr-2 pt-1 "></i>{{ __('Добавить') }}</a></p>

                    </div>
                    @if(count($subdeparts)>0)
                    <div class="card-body table-full-width table-responsive pl-4">
                        <div class="clearfix">
                            <div class="float-right ml-2 border rounded pr-2">
                                <form class=" pt-0" action="{{ route('sub_sortdepartments' ) }}" method="GET">
                                    @csrf

                                    <div class="btn-group bootstrap-select dropup p-2 mb-1">
                                        <label for="selectDepart" class="form-text text-muted pt-1">Отдел: </label>&nbsp;&nbsp;
                                        <select class="select-my" aria-label="select depart" id="selectDepart" name="selectDepart">
                                            <option selected value="0">Все</option>
                                            @foreach ($departs as $depart)
                                            <option value="{{ $depart->id }}" @if ($depart->id == $idDepart) selected="selected" @endif>{{ $depart->name_depart }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info p-2 ml-1 ">Показать </button>
                                </form>
                            </div>
                        </div>
                        <div class="">
                            <p class="ml-2 pb-2 border-bottom">Всего: {{ $subdepartsCount }}</p>
                            <table class="table table-hover table-striped ml-2">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Отдел</th>
                                        <th>Подразделение</th>
                                        <th>Приоритет</th>
                                        <th>Дата создания</th>
                                        <th>Дата изменения</th>
                                        <th>События</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subdeparts as $subdepart)
                                    <tr>
                                        <td>{{ ($subdeparts->currentpage()-1) * $subdeparts->perpage() + $loop->index + 1 }}</td>
                                        <td>{{ $subdepart->department->name_depart }}</td>
                                        <td>{{ $subdepart->name_subdepart }}</td>
                                        <td>{{ $subdepart->priori_sub }}</td>
                                        <td>{{ date('d-m-Y H:i:s',strtotime($subdepart->created_at)) }}</td>
                                        <td>
                                            @if($subdepart->created_at != $subdepart->updated_at)
                                            <span style="color:#852A00">{{ date('d-m-Y H:i:s',strtotime($subdepart->updated_at)) }}</span>
                                            @else
                                            {{ date('d-m-Y H:i:s',strtotime($subdepart->updated_at)) }}
                                            @endif
                                        </td>
                                        <td><a class="btn  btn-warning btn-fill" href="{{ route('sub_departments.edit', ['sub_department'=>$subdepart->id ] ) }}"><i class="nc-icon nc-settings-tool-66"></i> {{ __('Изменить') }}</a></td>
                                    </tr>
                                    @empty
                                    <p>Отделы не найдены</p>
                                    @endforelse
                                    @else
                                    <p class="pl-4">Справочник пуст, записей не найдено.</p>
                                    @endif
                                </tbody>
                            </table>
                            @if( $subdepartsCount)
                            <p class="ml-2 pt-2 border-top">Отражено: {{ $subdeparts->count() }}</p>
                            @endif
                            <div class="pagination justify-content-center">{{ $subdeparts->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
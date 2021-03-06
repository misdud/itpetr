@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Редактирование справочников',
'navName' => 'Справочники', 'activeButton' => 'false', ])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for catalog --}}
                    @include('pages.manager.links_svods', ['test'=>'svodks'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3"> Сводка по правилам:
                            <span class="font-weight-bold"> Общие </span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с &#9668; <a class="border-bottom" href="{{ route('svodks.index') }}">Сводка правил </a> &#9658;</p>
                        <p class="card-category pt-3 pl-2"><a class="btn  btn-primary btn-fill  float-right" href="{{ route('svodks.create') }}"><i class="nc-icon nc-simple-add pr-2 pt-1"></i>{{ __('Добавить') }}</a></p>

                    </div>
                    <div class="clearfix">
                        <div class="float-right mr-3 border rounded ">
                            <form class=" col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('post_search' ) }}" method="GET">
                                @csrf

                                <div class="btn-group bootstrap-select dropup p-1">
                                    <input type="search" name="search" class="form-control form-control-dark" placeholder="Поиск по теме...">
                                </div>
                                <button type="submit" class="btn btn-info pt-2">Найти </button>
                            </form>
                        </div>
                    </div>
                    
                    @if (session('message_info'))
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.info')
                    </div>
                    @endif

                    @if(count($svods)>0)
                    <div class="card-body table-full-width table-responsive pl-4">
                        <p class="ml-2 pb-2 border-bottom">Всего: {{ $svods->count() }}</p>
                        <table class="table table-hover table-striped ml-2">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Тема</th>
                                    <th>Автор</th>
                                    <th>Инфа</th>
                                    <th>Дата изменения &#9660;</th>
                                    <th>События</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($svods as $svod)
                                <tr>
                                    <td>{{ ($svods->currentpage()-1) * $svods->perpage() + $loop->index + 1 }}</td>
                                    <td><a class="text-white bg-dark rounded p-2" href="{{ route('svodks.show', ['svodk'=>$svod->id ] ) }}"><i class="nc-icon nc-puzzle-10  pl-1 pr-1"></i>{{ mb_strimwidth($svod->post, 0, 25, "...") }}</a></td>
                                    
                                    <td>{{ mb_strimwidth($svod->user->fio_full, 0, 35, "...") }}</td>
                                    <td>{{ mb_strimwidth($svod->info, 0, 35, "...") }}</td>
                                    <td>
                                        @if($svod->created_at != $svod->updated_at)
                                        <span style="color:#852A00">{{ date('d-m-Y H:i:s', strtotime($svod->updated_at)) }}</span>
                                        @else
                                        {{ date('d-m-Y H:i:s', strtotime($svod->updated_at)) }}
                                        @endif
                                    </td>
                                    @if( Auth::user()->id == $svod->user->id )
                                    <td><a class="btn-sm  btn-warning btn-fill" href="{{ route('svodks.edit', ['svodk'=>$svod->id ] ) }}"><i class="nc-icon nc-settings-tool-66"></i> {{ __('Изменить') }}</a></td>
                                    @else
                                    <td>нет доступа</td>
                                    @endif
                                </tr>
                                @empty
                                <p> Не найдены</p>
                                @endforelse
                                @else
                                <p class="pl-4">Записей не найдено.</p>
                                @endif
                            </tbody>
                        </table>
                        @if( $svods->count() )
                        <p class="ml-2 pt-2 border-top">Отражено: {{ $svods->count() }}</p>
                        @endif
                        <div class="pagination justify-content-center">{{ $svods->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
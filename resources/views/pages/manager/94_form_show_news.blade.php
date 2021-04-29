@extends('layouts.app_pages', ['activePage' => 'false', 'title' => 'Добавление записи',
'navName' => 'Справочники', 'activeButton' => 'false'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for list --}}
                    @include('pages.manager.links_news', ['test'=>'news'])

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <h4 class="card-title display-5  bg-info rounded-top p-3">Просмотр новости
                            <span class="font-weight-bold">&#9658; {{ $newOne->news_post }}</span>
                        </h4>
                        <p class="card-category pt-3 pl-2">Работа с &#9668;<a class="border-bottom" href="{{ route('news.index') }}">Новостями</a> &#9658;</p>
                    </div>

                    @if ($errors->any())
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.errors')
                    </div>
                    @endif

                    <div class=" ml-4 mr-4 mt-3 border rounded">
                       <div class="p-4">
                            <p class="h4 "><b>Тема: </b> <span class="text-dark bg-warning rounded p-1 pl-2 pr-2">{{ $newOne->news_post }}</span></p><hr>
                            <p class="h5"><b>Контекст:</b></p>
                                @foreach( explode(PHP_EOL, $newOne->news_info) as $paragraph)
                                         <p style="text-indent: 15px;">{{ $paragraph }}</p>
                                @endforeach
                            <hr>
                               <p>
                                    @if($newOne->news_activ == 1 )
                                        <span class="bg-success rounded p-1 ">Активна</span>
                                    @else
                                        <span class="bg-danger rounded p-1 ">Не активна</span>
                                    @endif
                                 </p>
                            <p class="float-left "><small><b >Автор: </b>{{ $newOne->user->fio_full }}<b> | Создал:</b> {{ date('d-m-Y H:i:s', strtotime($newOne->created_at)) }}
                            <b> | Обновил:</b> {{ date('d-m-Y H:i:s', strtotime($newOne->updated_at))  }}</small></p>
                       </div>
                    </div>
                    <p><a class="btn  btn-info btn-fill float-right mr-4 mt-2" href="{{ route('news.index') }}">Назад </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
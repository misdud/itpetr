@extends('layouts.app_pages', ['activePage' => 'news', 'title' => 'Просмотр новости',
'navName' => 'Просмотр новости', 'activeButton' => 'news'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group">
                    <a class="btn btn-secondary active" href="{{ route('show_list_news') }}" role="button"><i class="nc-icon nc-bell-55 pr-2"></i>Новости</a>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover pt-2">
                    <div class="card-header">
                        <p class="ml-2"><a class="btn btn-info" href="{{ route('show_list_news') }}">Список новостей</a></p>
                    </div>

                    @if ($errors->any())
                    <div class="ml-3 mr-3 mt-3">
                        @include('alerts.errors')
                    </div>
                    @endif

                    <div class=" ml-3 mr-3 mt-1 border rounded">
                        <div class="pl-4 pr-4 pb-4 pt-2">
                            <p class="h5 pt-5 pb-1 pl-2 border-bottom"><b>{{ $newOne->news_post }}</b></p>
                            
                            @foreach( explode(PHP_EOL, $newOne->news_info) as $paragraph)
                            <p style="text-indent: 15px;">{{ $paragraph }}</p>
                            @endforeach
                            <hr>
                            <p class="float-left "><small><b>Автор: </b>{{ $newOne->user->fio_full }}<b> | Создал:</b> {{ date('d-m-Y H:i:s', strtotime($newOne->created_at)) }}
                                    <b> | Обновил:</b> {{ date('d-m-Y H:i:s', strtotime($newOne->updated_at))  }}</small></p>
                        </div>
                    </div>
                    <p><a class="btn  btn-info btn-fill float-right mr-4 mt-2" href="{{ route('show_list_news') }}">Назад </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
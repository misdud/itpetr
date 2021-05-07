@extends('layouts.app_pages', ['activePage' => 'news', 'title' => 'Новости', 'navName' => 'Новости', 'activeButton' => 'news'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group card-body" role="group">
                    <a class="btn btn-secondary active" href="{{ route('show_list_news') }}" role="button"> <i class="nc-icon nc-bell-55 pr-2"></i>Новости</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Новости и события предприятия</h4>
                        <p class="card-category">Список всех новостей и событий</p>
                    </div>
                    <div class="card-body table-full-width table-responsive ml-1 mr-1">
                        <table class="table table-borderless table-hover table-striped mt-3">
                            <thead>
                                <th>№</th>
                                <th>Дата создания</th>
                                <th>Тема</th>
                                <th>Кратко</th>
                                <th>Автор</th>
                                <th>Должность</th>
                            </thead>
                            <tbody>
                                @forelse($news as $newOne)
                                <tr>
                                    <td>{{ ($news->currentpage()-1) * $news->perpage() + $loop->index + 1 }}</td>
                                    <td>{{ date('d-m-y H:i:s', strtotime($newOne->updated_at)) }}</td>
                                    <td><a class="text-info rounded p-2" href="{{ route('show_news_one', ['id'=>$newOne->id ] ) }}"><i class="nc-icon nc-stre-right pr-1"></i><b>{{ mb_strimwidth($newOne->news_post, 0, 35, "...") }}</b></td>
                                    <td>{{ mb_strimwidth($newOne->news_info, 0, 60, "...") }}</td>
                                    <td>{{ $newOne->user->fio_full }}</td>
                                    <td>{{ $newOne->user->position->name_position }}</td>
                                </tr>
                                @empty
                                <p class="pl-4">Записей не найдено.</p>
                                @endforelse

                            </tbody>
                        </table>
                        @if( $newsCount)
                        <p class="ml-2 pt-2 border-top">Всего: {{ $newsCount }}</p>
                        @endif
                        <div class="pagination justify-content-center">{{ $news->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
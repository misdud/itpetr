@extends('layouts.app_pages', ['activePage' => 'busschedule', 'title' => 'Расписание автобусов', 'navName' => 'Расписание автобусов', 'activeButton' => 'busschedule'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for busschedule  --}}
                    @include('busschedule.links_busschedule', ['num'=>'one'])
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Расписание маршрута №1</h4>
                        <p class="card-category">Обновлено: 01.05.2021г.</p>
                    </div>
                    <div class="card-body ">
                    <object data="{{ asset('light-bootstrap/pdf/busshedule/marshrut_3_21_04_21.pdf') }}" type="application/pdf"
                      width="100%" height="800"></object>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
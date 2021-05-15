@extends('layouts.app_pages', ['activePage' => 'busschedule', 'title' => 'Расписание автобусов', 'navName' => 'Расписание автобусов', 'activeButton' => 'busschedule'])

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
                        <h4 class="card-title">Именинники</h4>
                        <p class="card-category">Список  именинников </p>
                    </div>
                    <div class="card-body">
                    @if(file_exists( public_path().'/light-bootstrap/pdf/dr/dr_'.$dateMount.'.pdf' ))
                    <object data="{{ asset('light-bootstrap/pdf/dr/dr_'.$dateMount.'.pdf') }}" type="application/pdf"
                      width="100%" height="800">
                    </object>
                    @else
                    <object data="{{ asset('light-bootstrap/pdf/dr/dr_not_load.pdf') }}" type="application/pdf"
                      width="100%" height="800">
                    </object>
                    @endif	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
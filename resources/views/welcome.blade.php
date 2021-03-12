@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Главная', ])


@section('content')
<div class="full-page section-image" data-color="black" data-image="{{asset('light-bootstrap/img/full-screen-image-2.jpg')}}">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">

                    <h2 class="text-white text-center">{{ __('Добро пожаловать !') }}</h2>

                </div>
            </div>
            <div class="row justify-content-center pl-2 pr-2">
                <div class="card ml-2" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema') }}">Основная мнемосхема</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema_param') }}">Схемы\Отчёты\Тренды</a></li>
                    </ul>
                </div>
                <div class="card ml-2" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-single-copy-04 pt-1"></i>
                        <b class="pb-2">ОТЧЁТЫ</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_raport_ru') }}">Отчет о работе РУ</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_raport_sof') }}">Отчет о работе СОФ</a></li>
                    </ul>
                </div>
                <div class="card ml-2" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema') }}">Основная мнемосхема</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema_param') }}">Главная мнемосхема</a></li>
                    </ul>
                </div>
                <div class="card ml-2" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema') }}">Основная мнемосхема</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema_param') }}">Главная мнемосхема</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                    <a class="btn btn-round btn-secondary btn-fill  ml-1" href="{{ route('main_schema') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('МНЕМОСХЕМА ГЛАВНАЯ') }}</a>
                    <a class="btn btn-round btn-warning btn-fill  ml-1" href="{{ route('main_raport_ru') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Отчет о работе РУ') }}</a>
                    <a class="btn btn-round btn-info btn-fill  ml-1" href="{{ route('main_raport_sof') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Отчет о работе СОФ') }}</a>
                    <a class="btn btn-round btn-primary btn-fill  ml-1" href="{{ route('main_schema_param') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Мнемосхемема & параметры') }}</a>
                    <a class="btn btn-round btn-info btn-fill  ml-1" href="{{ route('main_schema_param') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Мнемосхемема & параметры') }}</a>
                </div>
            <hr>
            
        </div>
    </div>
    @endsection


    @push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
    @endpush
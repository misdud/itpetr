@extends('layouts/app', ['activePage' =>'mainSchema', 'title' => 'Главная мнемосхема', ])

@section('content')

    <div class="">
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('welcome') }}">Главная страница</a>
        <a  class="text-danger" style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('main_schema') }}">Основная мнемосхема</a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('main_raport_ru') }}">Отчет о работе РУ </a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('main_raport_sof') }}">Отчет о работе СОФ </a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('main_schema_param') }}">Схемы\Отчёты\Тренды</a>
            <iframe src={{ $urlScemaPetricovMain }} width="100%" height="980" noresize target="_top" style="
                    -webkit-transform: scale(0.99);
                    transform: scale(0.99);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                    padding:0 0;
                    margin: 0px 0px 0px 0px;">
                <h2>Ваш браузер не поддерживает плавающие фреймы!</h2>
            </iframe>
        </div>
</div>

@endsection
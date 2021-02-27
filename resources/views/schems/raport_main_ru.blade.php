@extends('layouts/app', [ 'activePage' =>'mainRaportRu','title' => 'Отчёты по руднику', ])

@section('content')

    <div class="">
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('welcome') }}">Главная страница</a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('mainSchema') }}">Общая мнемосхема</a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" class="text-danger" href="{{ route('mainRaportRu') }}">Отчет о работе РУ </a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('mainRaportSof') }}">Отчет о работе СОФ </a>
        <a style="border-right:1px dotted blue; padding:5px 5px; font-size:14px; color:blue;" href="{{ route('mainSchemaParam') }}">Мнемосхемема & параметры</a>
        <div >
            <iframe src={{ $urlRaportPetricovMain }} width="100%" height="1000" noresize style="
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
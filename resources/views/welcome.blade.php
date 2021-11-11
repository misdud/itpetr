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
                <div class="card ml-2 shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema') }}">Основная мнемосхема</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_schema_param') }}">Схемы\Отчёты\Тренды</a></li>
                    </ul>
                </div>
                <div class="card ml-2 shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-single-copy-04 pt-1"></i>
                        <b class="pb-2">ОТЧЁТЫ</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_raport_ru') }}">Отчет о работе РУ</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('main_raport_sof') }}">Отчет о работе СОФ</a></li>
                    </ul>
                </div>
                <div class="card ml-2 shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white"  href=" http://172.17.100.22/Droblenie/" target="_blank">Дробление общая</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href=" http://172.17.100.22/Sushka/" target="_blank">Сушка общая</a></li>
                    </ul>
                </div>
                <div class="card ml-2 shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1"><i class="nc-icon nc-layers-3 pt-1"></i>
                        <b class="pb-2">МНЕМОСХЕМЫ</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white"  href=" http://172.17.100.22/Sguschenie/" target="_blank">Сгущение</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white"  href=" http://172.17.100.22/soleotval/" target="_blank">Солеотвал</a></li>
                    </ul>
                </div>                 
            </div>
            <div class="row justify-content-center">
                <a class="btn btn-round  btn-primary btn-fill shadow ml-1" href="http://it.kali" target="_blank"><i class="nc-icon nc-check-2 pr-2 pt-1"></i>{{ __('IT.KALI') }}</a>
                <a class="btn btn-round btn-warning btn-fill  ml-1" href="https://it.kali/advanced-search" target="_blank"><i class="nc-icon nc-zoom-split pr-2 pt-1"></i>{{ __('Поис сотрудников') }}</a>
                <a class="btn btn-round btn-info btn-fill  ml-1" href="{{ route('main_raport_sof') }}" target="_blank"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Отчет о работе СОФ') }}</a>
                <a class="btn btn-round btn-primary btn-fill  ml-1" href="{{ route('main_schema_param') }}" target="_blank"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('Мнемосхемема & параметры') }}</a>
            </div>
            <hr>
            @can('show_admin')
            <div class="row justify-content-center">
                <div class="card ml-2 bg-info shadow " style="width: 14rem;">
                    <div class="card-header bg-primary pt-1 pb-1"><i class="nc-icon nc-tv-2 pt-1"></i>
                        <b class="pb-2">Zabbix Петриков</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.17.100.108/zabbix.php?action=map.view&sysmapid=4" target="_blank">Офисная карта</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.17.100.108/zabbix.php?action=map.view&sysmapid=3" target="_blank">Промышленная карта</a></li>
                    </ul>
                </div>
                <div class="card ml-2  bg-warning shadow" style="width: 14rem;">
                    <div class="card-header bg-warning  pt-1 pb-1"><i class="nc-icon nc-tv-2 pt-1"></i>
                        <b class="pb-2">Zabbix Солигорск</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.16.1.234/zabbix/zabbix.php?action=map.view&sysmapid=1" target="_blank">Сеть ОАО "Беларуськалий"</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.16.1.234/zabbix/zabbix.php?action=dashboard.view&dashboardid=1" target="_blank">Сеть ОАО Основная</a></li>
                    </ul>
                </div>
                <div class="card ml-2 bg-success shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1 bg-success"><i class="nc-icon nc-support-17 pt-1"></i>
                        <b class="pb-2">Инфо 1</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="{{ route('svodks.index')}}">Сводка админов</a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.17.100.30/1-1" target="_blank">PressCater</a></li>
                    </ul>
                </div>
                <div class="card ml-2 bg-success shadow" style="width: 14rem;">
                    <div class="card-header pt-1 pb-1 bg-success"><i class="nc-icon nc-support-17 pt-1"></i>
                        <b class="pb-2">Инфо 2</b>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://172.16.1.112/search.php" target="_blank">Поиск пользователей </a></li>
                        <li class="list-group-item bg-secondary nav-item pt-1 pb-1 pl-3"><a class="text-white" href="http://radio.kali/" target="_blank">Radio</a></li>
                    </ul>
                </div>
            </div>
            @endcan
            @auth
            <div class="row justify-content-center mt-5">
                <div class="mr-5 p-1 bg-secondary border rounded">
                    <a href=https://www.calend.ru/holidays/belorus/ target=_blank><img src="https://www.calend.ru/img/export/informer_7.png" width="150" alt="Праздники Беларуси" border="0"></a>
                </div>
                <!--https://www.pogoda.by-->
                <!--Информер распространяется свободно и на безвозмездной основе. Однако, в случае изменения кода информера (в частности, удаления ссылок), https://www.pogoda.by снимает с себя ответственность за конечный результат.-->
                <div class="mr-5 p-1 bg-secondary border rounded">
                    <table width="300" height="255" style="background-color:#f2f2f2; border: #cccccc 1px solid; font-family:Tahoma; font-size:12px; color:#000000;" cellpadding="2" cellspacing="0">
                    <tr><td><a href="//pogoda.by/weather/numerical-weather-6/521285" style="font-family:Tahoma; font-size:12px; color:#003399;" title="Погода Петриков на 6 дней - Гидрометцентр РБ" target="_blank">Погода Петриков</a>
                     </td></tr>
                       <tr><td> 
                         <table width=100% height=100% style="background-color:#f2f2f2; font-family:Tahoma; font-size:12px; color:#000000;" cellpadding="0" cellspacing="0">
                              <tr><td id="pogoda-by-informer-521285-3">
                            <table width="100%" height="100%" style="background-color:#f2f2f2; font-family:Tahoma; font-size:12px; color:#000000;" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr><td></td></tr>
                                <tr><td></td><td colspan="2"><u>Ночь</u></td><td colspan="2"><u>День</u></td></tr>
                                <tr>
                                    <td>11.11&nbsp;</td>
                                    <td>-1°C</td>
                                    <td><div title="Облачно"><img height="24" src="//pogoda.by/assets/icons-weather/wi_night_3.png"></div></td>
                                    <td>+4..+6°C</td>
                                    <td><div title="Облачно"><img height="24" src="//pogoda.by/assets/icons-weather/wi_day_3.png"></div></td>
                                </tr>
                                <tr>
                                    <td>12.11&nbsp;</td>
                                    <td>+2°C</td>
                                    <td><div title="Облачно"><img height="24" src="//pogoda.by/assets/icons-weather/wi_night_3.png"></div></td>
                                    <td>+5..+8°C</td>
                                    <td><div title="Облачно"><img height="24" src="//pogoda.by/assets/icons-weather/wi_day_3.png"></div></td>
                                </tr>
                                <tr>
                                    <td>13.11&nbsp;</td>
                                    <td>0..+2°C</td>
                                    <td><div title="Туман"><img height="24" src="//pogoda.by/assets/icons-weather/wi_night_4.png"></div></td>
                                    <td>+3..+6°C</td>
                                    <td><div title="Малооблачно"><img height="24" src="//pogoda.by/assets/icons-weather/wi_day_2.png"></div></td>
                                </tr>

                            </tbody>
                            </table>

                        </td></tr>
                        </table>

                        </td></tr>

                        <tr><td align="right">Информация сайта <a href="//www.pogoda.by" target="_blank" style="font-family:Tahoma; font-size:12px; color:#003399;">pogoda.by</a>
                        </td></tr>
                        </table>
                </div>
                <div сlass="">
                    <ul  style="background: radial-gradient(circle farthest-corner at 100px 50px, #DEDFE3, #B5BAC9);border-radius:10px; padding:7px;">
                        <li style="list-style-type: none;font-size: 12px;"> &#9658; +375 <b><span style="color: #696dfb; font-size: 12px">24</span></b> XXX XX XX — <span style="color: #696dfb; font-size: 12px">Белтелеком </span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b><span style="color: #f56c79; font-size: 12px">25</span></b> XXX XX XX — <span style="color: #f56c79; font-size: 12px">life:)</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: yellow; font-size: 12px">1</span></b> XX XX XX — <span style="color: yellow; font-size: 12px">A1</span></li>
			            <li style=" list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: red; font-size: 12px">2</span></b> XX XX XX — <span style="color: red; font-size: 12px">МТС</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: yellow; font-size: 12px">3</span></b> XX XX XX — <span style="color: yellow; font-size: 12px">A1</span></li>
			            <li style=" list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: #696dfb; font-size: 12px">4</span></b> XX XX XX — <span style="color: #696dfb; font-size: 12px">Diallog</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: red; font-size: 12px">5</span></b> XX XX XX — <span style="color: red; font-size: 12px">МТС</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: yellow; font-size: 12px">6</span></b> XX XX XX — <span style="color: yellow; font-size: 12px">A1</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: red; font-size: 12px">7</span></b> XX XX XX — <span style="color: red; font-size: 12px">МТС</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: red; font-size: 12px">8</span></b> XX XX XX — <span style="color: red; font-size: 12px">МТС</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b>29 <span style="color: yellow; font-size: 12px">9</span></b> XX XX XX — <span style="color: yellow; font-size: 12px">A1</span></li>
		            	<li style=" list-style-type: none; font-size: 12px;"> &#9658; +375 <b><span style="color: red; font-size: 12px">33</span></b> XXX XX XX — <span style="color: red; font-size: 12px">МТС</span></li>
                        <li style="list-style-type: none; font-size: 12px;"> &#9658; +375 <b><span style="color: yellow; font-size: 12px">44</span></b> XXX XX XX — <span style="color: yellow; font-size: 12px">A1</span></li>
                    </ul>
                </div>
                <div class="m-3"></div>
                <div сlass="">
                    <iframe сlass="" frameborder="1" height="133" marginheight="1" marginwidth="1" scrolling="no" src="https://admin.myfin.by/outer/informer/soligorsk/full" width="90%"></iframe>
                </div>

            </div>
            @endauth
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
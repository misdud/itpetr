<div class="sidebar" data-color="black" data-image="{{ asset('light-bootstrap/img/sidebar-33.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('welcome') }}" class="simple-text">
            <img src="{{ asset('light-bootstrap/img/icon-belaruskali_1.png') }}" class="img-fluid pb-2" width="20" alt="Belaruskali" >
            {{ __("ITPetrik.KALI") }}
            </a>
        </div>
        <ul class="nav">
            {{-- <!--    Comment Dash        -->
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>{{ __("Показатели") }}</p>
                    </a>
            </li>
            --}}
            <li class="nav-item @if($activePage == 'managers') active @endif">
                <a class="nav-link" href="{{route('managers')}}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>{{ __("Руководители") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'contacts') active @endif">
                <a class="nav-link" href="{{route('main_contacts')}}">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __("Контакты") }}</p>
                </a>
            </li>
           
            <li class="nav-item">
               <!--for admin setup ... <a class="nav-link" data-toggle="collapse" href="#laravelExamples" @if($activeButton = 'laravel') aria-expanded="true" @endif> -->
                <a class="nav-link" data-toggle="collapse" href="#laravelExamples" aria-expanded="true">
                    <i>
                        <img src="{{ asset('light-bootstrap/img/laravel.svg') }}" style="width:25px">
                    </i>
                    <p>
                        {{ __('Laravel example') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if($activeButton =='laravel') show @endif" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'user') active @endif">
                            <a class="nav-link" href="{{route('profile.edit')}}">
                                <i class="nc-icon nc-single-02"></i>
                                <p>{{ __("User Profile") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'user-management') active @endif">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>{{ __("User Management") }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item @if($activePage == 'table') active @endif">
                <a class="nav-link" href="{{route('page.index', 'table')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Table List") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'typography') active @endif">
                <a class="nav-link" href="{{route('page.index', 'typography')}}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>{{ __("Документы") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'icons') active @endif">
                <a class="nav-link" href="{{route('page.index', 'icons')}}">
                    <i class="nc-icon nc-atom"></i>
                    <p>{{ __("Icons") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'maps') active @endif">
                <a class="nav-link" href="{{route('page.index', 'maps')}}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __("Maps") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'notifications') active @endif">
                <a class="nav-link" href="{{route('page.index', 'notifications')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Notifications") }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active bg-info" href="{{route('main_catalogs')}}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>{{ __("Справочники") }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>

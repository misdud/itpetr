<nav class="navbar navbar-expand-xl " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> {{ $navName ?? 'test' }} </a>
        <button href="http://itpetr.kali" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

           {{--  ---------------------COMMENT--------------------------
           <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <span class="d-lg-none">{{ __('Авторизован') }}</span>
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-planet"></i>
                        <span class="notification">2</span>
                        <span class="d-lg-none">{{ __('Notification') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{ __('Notification 1') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 2') }}</a>
                    </ul>
                </li>
            </ul>
            ---------------------------                   --}}
            <ul class="navbar-nav   d-flex align-items-center">

                @can('show_admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://itpetrik.kali" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">{{ __('Адинистрирование') }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('main_catalogs') }}"><span class="bg-info rounded pl-2 pr-2">Role:admin</span> {{ __('Cправочники') }} </a>
                        <a class="dropdown-item" href="{{ route('wincc_tia_catalogs') }}"><span class="bg-info rounded pl-2 pr-2">admin</span> {{ __('Проекты WinCC\TIA') }}</a>
                        <a class="dropdown-item" href="{{ route('svodks.index') }}"><span class="bg-info rounded pl-2 pr-2">admin</span> {{ __('Сводка') }}</span></a>
                        <div class="divider"></div>
                        <a class="dropdown-item" href="{{ route('news.index') }}"> <span class="bg-warning rounded pl-2 pr-2">main_manager</span> {{ __('Управление новостями') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{route('users.show', ['user'=> Auth::user()->id ]) }} ">
                        <span class="no-icon">
                            @if( Auth::check() )
                            {{ Auth::user()->fio_full}}
                            @endif
                        </span>
                    </a>
                </li>
                @else
                <li class="nav-item pr-3">
                    @if( Auth::check() )
                    {{ Auth::user()->fio_full}}
                    @endif
                </li>
                @endcan
                <li class="nav-item dropdown">
                    <div class="dropdown-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nc-icon nc-button-power"></i> {{ __('ВЫХОД') }} </a>
                        </form>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</nav>
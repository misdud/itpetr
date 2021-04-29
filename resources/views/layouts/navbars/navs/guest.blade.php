<nav class="navbar navbar-expand-sm  navbar-absolute" style="background-color: #3E4446;">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ route('welcome') }}"><b>Главная</b></a> &#5125; <span class="navbar-brand">{{  $navName ?? ''  }}</span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
                {{--    ---------------COMENT-------------------

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="pr-1 nc-icon nc-chart-pie-35"></i>  {{ __('Панель') }}
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'register') active @endif">
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="pr-1 nc-icon nc-badge"></i> {{ __('Регистрация') }}
                    </a>
                </li>
                --}}

                <li class="nav-item @if($activePage == 'login') active @endif">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="pr-1 nc-icon nc-mobile"></i> {{ __('Вход') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
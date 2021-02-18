<!doctype html>
<html>

<head>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<style>
    * {
        font-family: sans-serif;
        color: rgba(0, 0, 0, 0.80);
    }

    body {
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100vh;
        padding: 0px 30px;
        background: #ddd;
    }

    .wrapper {
        max-width: 960px;
        width: 100%;
        margin: 30px auto;
        transform: scale(0.8);
    }

    .landing-page {
        max-width: 960px;
        height: 475px;
        margin: 0;
        box-shadow: 0px 0px 8px 1px #ccc;
        background: #fafafa;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    svg1 {
        width: 100%;
        max-height: 225px;
        height: auto;
        margin: 0 0 15px;
    }
</style>

<body>
    <div class="wrapper">
        <div class="landing-page">
            <div style="text-align:center;" class="icon__download">
                <svg width="200" height="180">
                    <path stroke="orange" stroke-width="10" fill="gold" d="M 100,20 L 180,160  L 20,160 z" />
                </svg>
            </div>

            <h1> 404 Ошибка.</h1>
            <p> Oops.Страница не найдена.</p>
            <div class="alert alert-success" role="alert">
                <a href="{{ route('login') }}" class="alert-link">Перейти на главную</a>
            </div>
        </div>
    </div>

</body>

</html>
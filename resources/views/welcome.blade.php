@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Главная', ])


@section('content')
    <div class="full-page section-image" data-color="black" data-image="{{asset('light-bootstrap/img/full-screen-image-2.jpg')}}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <h1 class="text-white text-center">{{ __('Welcome to Light Bootstrap Dashboard FREE Laravel Live Preview.') }}</h1>
                        <a class="btn btn-primary btn-fill Larger shadow" href="{{ route('mainSchema') }}"><i class="nc-icon nc-layers-3 pr-2 pt-1"></i>{{ __('МНЕМОСХЕМЫ') }}</a>
                    </div>
                </div>
            </div>
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
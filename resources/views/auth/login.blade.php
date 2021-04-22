@extends('layouts/app')

@section('content')
<div class="full-page section-image" data-color="black" data-image="{{ asset('light-bootstrap/img/full-screen-image-2.jpg') }}">
    <div class="content pt-5">
        <div class="container pt-5">
            <div class="col-lg-5 col-md-5 col-sm-8 ml-auto mr-auto">
                <form class="form border border-white rounded" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-login card-hidden">{{--  card --}}
                        <div class="card-header ">
                            <div class="text-center">
                                <img src="{{ asset('light-bootstrap/img/icon-belaruskali_150.png') }}" class="img-fluid" alt="Belaruskali">
                            </div>
                            <h3 class="header text-center">{{ __('ВХОД') }}</h3>
                        </div>
                        <div class="card-body ">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="idNumberTab" class="form-label col-md-6 col-form-label">{{ __('Табельный №:') }}</label>

                                    <div class="col-md-14">
                                        <input id="idNumberTab" type="text" class="form-control @error('tab_number') is-invalid @enderror" name="login"  required >

                                        @error('tab_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label col-md-6 col-form-label">{{ __('Пароль:') }}</label>

                                        <div class="col-md-14">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required >

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox pr-2  my-1 mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                            <label class="custom-control-label " for="remember">Запомнить меня</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <div class="container text-center">
                                <div class="text-info">Вход возможен только для пользователей Петриковского ГОК.</div>
                                    <button type="submit" class="btn btn-warning btn-wd">{{ __('Вход') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="pl-3 text-dark">Доступ предоставляется по требованию руководителя (Справка по тел.:00-88).</div>
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
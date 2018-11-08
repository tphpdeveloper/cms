<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <title> @yield('login_title', 'Вход в админ панель') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/now-ui-dashboard.css?v=1.1.0') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/login.css') }}"/>
</head>

<body style="background-image: url({{ asset('backend/img/bg14.jpg') }}) ">

<div class="container-fluid">
    <div class="col-md-4 ml-auto mr-auto">
        {!! Form::open(['route' => 'admin.login', 'method' => 'POST']) !!}
        <div class="card bg-transparent m-auto ">

            <div class="card-header ">
                <div class="logo-container text-center">
                    <img src="{{ asset('backend/img/now-logo.png') }}" alt="" class="rounded">
                </div>
            </div>

            <div class="card-body">
                @if($errors->first()))
                    <div class="alert alert-danger no-border">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="input-group no-border form-control-lg ">
                    <span class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="now-ui-icons users_circle-08 "></i>
                        </div>
                    </span>
                    {!! Form::email('email', '' ?? old('email'), [
                        'class' => 'form-control ',
                        'placeholder' => trans('cms.helpers.form.login')
                    ]) !!}
                </div>

                <div class="input-group no-border form-control-lg">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="now-ui-icons text_caps-small "></i>
                        </div>
                    </div>
                    {!! Form::password('password', [
                            'class' => 'form-control ',
                            'placeholder' => trans('cms.helpers.form.password')
                    ]) !!}
                </div>
            </div>

            <div class="card-footer ">
                {!! Form::bsButtonSave(trans('cms.helpers.button.login'), [
                    'class' => 'btn btn-primary btn-round btn-lg btn-block mb-3',
                    'title' => trans('cms.helpers.button.login')
                ]) !!}
            </div>

        </div>
        {!! Form::close() !!}

    </div>
</div>


</body>
</html>

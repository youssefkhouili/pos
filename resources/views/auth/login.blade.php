{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- bootstrap 4.5  --}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/noty.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('dashboard/css/adminlte.min.css') }}">
  <!-- Font Awesome -->
  @if (app()->getLocale() === 'ar')
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/adminlte-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">
  @else
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @endif
  <link rel="stylesheet" href="{{ asset ('dashboard/css/style.css') }}">
</head>
<body class="login-page">

<div class="login-box">

    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div><!-- end of login lgo -->

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}

            @include('admin.partials._errors')

            <div class="form-group has-feedback" style="position: relative">
                <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                <i class="fas fa-envelope" style="position: absolute; top: 10px; left: 10px"></i>
            </div>

            <div class="form-group has-feedback" style="position: relative">
                <input type="password" name="password" class="form-control" placeholder="@lang('site.password')">
                <i style="position: absolute; top: 10px; left: 10px" class="fas fa-key"></i>
            </div>

            <div class="form-group">
                <label style="font-weight: normal;"><input type="checkbox" name="remember"> @lang('site.remember_me')</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.login')</button>

        </form><!-- end of form -->

    </div><!-- end of login body -->

</div><!-- end of login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('dashboard/js/noty.min.js') }}"></script>


</body>
</html>

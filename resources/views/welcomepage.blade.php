<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <style>
            body{
                background: #ffffff;
            }
            .form-control {
                border-radius: 0;
                background: #fafafa !important;
                color: #000000;
            }
        </style>
    </head>
    <body>
    @if (Route::has('login'))
        @auth
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/home') }}">Home</a>
            </div>
        </div>
        @else
        <div class="flex-center position-ref full-height" style="min-height: 100vh">
                <div class="py-4 container" style="width: 60vw; margin: 0 auto;">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <img src="storage/images/phones.jpg" alt="phones">
                        </div>
                        <div class="col-6">
                            <form method="POST" action="{{ route('login') }}" class="form-group">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                    </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            <hr>
                                            <a href="{{ route('register') }}" class="btn btn-link text-center">{{__("I don't have an account")}}</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
        </div>
    @endif
    </body>
</html>

@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
          <img src="{{ asset('assets/stisla/img/stisla-fill.svg') }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
        </div>

        <div>@include('includes.alerts')</div>

        <div class="card card-primary">
          <div class="card-header">
            <h4>Login</h4>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email or Username</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                  <div class="float-right">
                    <a href="#" class="text-small">
                      Forgot Password?
                    </a>
                  </div>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me"
                    {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-5 text-muted text-center">
          Don't have an account? <a href="{{ route('register') }}">Create One</a>
        </div>
        <div class="simple-footer">
          Copyright &copy; Stand Blog 2021
        </div>
      </div>
    </div>
  </div>
@endsection

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
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

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
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>

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
@endsection

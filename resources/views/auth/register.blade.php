@extends('layouts.auth')

@section('title', 'Register')

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="login-brand">
          <img src="{{ asset('assets/stisla/img/stisla-fill.svg') }}" alt="logo" width="100"
            class="shadow-light rounded-circle">
        </div>

        <div>@include('includes.alerts')</div>

        <div class="card card-primary">
          <div class="card-header">
            <h4>Register</h4>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="row">
                <div class="form-group col-6">
                  <label for="name">Name</label>
                  <input id="name" type="text" class="form-control" name="name" autofocus value="{{ old('name') }}">
                </div>
                <div class="form-group col-6">
                  <label for="username">Username</label>
                  <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                </div>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>

              <div class="row">
                <div class="form-group col-6">
                  <label for="password" class="d-block">Password</label>
                  <input id="password" type="password" class="form-control" name="password">
                </div>
                <div class="form-group col-6">
                  <label for="password_confirmation " class="d-block">Password Confirmation</label>
                  <input id="password_confirmation " type="password" class="form-control" name="password_confirmation">
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                  <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; Stand Blog 2021
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Change Password')

@section('content')
  <section class="section-header">
    <h1>Change Password</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Change Password</div>
    </div>
  </section>

  <section class="section-body">
    <div class="row mt-4">
      <div class="col-12">


        @include('includes.alerts')

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <form action="{{ route('admin.update_password') }}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input class="form-control" type="password" name="current_password" id="current_password">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@extends('layouts.dashboard')

@section('title', 'Edit Profile')

  @push('styles')
    <style>
      .avatar_wrapper .avatar {
        width: 125px;
        height: 125px;
        border-radius: 50%;
        border: 1px solid #ccc;
        overflow: hidden;
        display: inline-block;
        margin-right: 20px;
      }

      .avatar_wrapper .avatar img {
        width: 100%;
        height: 100%;
      }

      .avatar_wrapper {
        display: flex;
        align-items: center
      }

      #avatar {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
      }

    </style>
  @endpush

@section('content')
  <section class="section-header">
    <h1>Edit Profile</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Edit Profile</div>
    </div>
  </section>

  <section class="section-body">
    <div class="row mt-4">
      <div class="col-12">

        @include('includes.alerts')

        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.update_profile') }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="form-group">

                <div class="avatar_wrapper">
                  <div class="avatar">
                    <img id="avatar_image" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                  </div>
                  <div>
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                    <label style="cursor: pointer; text-decoration: underline;" class="m-0" for="avatar"><span>Change
                        profile image</span></label>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username"
                    value="{{ $user->username }}">
                </div>
                <div class="form-group col-md-6">

                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Profile</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@push('scripts')
  <script>
    $(function() {
      $('#avatar').change(function(e) {
        const file = $(this)[0].files[0]
        if (file) {
          const reader = new FileReader()
          reader.onload = function(e) {
            $('#avatar_image').attr('src', e.target.result)
          }
          reader.readAsDataURL(file)
        }
      })
    })

  </script>
@endpush

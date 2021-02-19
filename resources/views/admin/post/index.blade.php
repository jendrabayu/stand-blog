@extends('layouts.dashboard')

@section('title', 'Post')

@section('content')
  <section class="section-header">
    <h1>Post</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Post</div>
    </div>
  </section>

  <section class="section-body">
    <div class="row">
      <div class="col-12">
        <post-component create-post-link="{{ route('admin.post.create') }}" />
      </div>
    </div>
  </section>
@endsection

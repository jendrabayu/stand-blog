@extends('layouts.dashboard')

@section('title', 'Tag')

@section('content')
  <section class="section-header">
    <h1>Tag</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Tag</div>
    </div>
  </section>

  <section class="section-body">
    <tag-component />
  </section>
@endsection

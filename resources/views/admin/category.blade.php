@extends('layouts.dashboard')

@section('title', 'Category')

@section('content')
  <section class="section-header">
    <h1>Category</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Category</div>
    </div>
  </section>

  <section class="section-body">
    <category-component />
  </section>
@endsection

@extends('layouts.dashboard')

@section('title', 'Create Post')

@section('content')
  <section class="section-header">
    <h1>Create Post</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.post.index') }}">Post</a></div>
      <div class="breadcrumb-item">Create Post</div>
    </div>
  </section>
  <div class="row">
    <div class="col-12">
      @include('includes.alerts')
      <div class="card">
        <div class="card-header">
          <h4>Write Your Post</h4>
          <div class="card-header-action">
            <a href="{{ route('admin.post.index') }}" class="btn btn-primary">See all post</a>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Title</label>
              <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control" name="title" tabindex="1" autofocus value="{{ old('title') }}">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Category</label>
              <div class="col-sm-12 col-md-10">
                <select class="form-control select2" name="category_id" tabindex="2">
                  <option selected disabled></option>
                  @foreach ($categories as $id => $title)
                    <option {{ old('category_id') && old('category_id') == $id ? 'selected' : '' }}
                      value="{{ $id }}">
                      {{ $title }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Content</label>
              <div class="col-sm-12 col-md-10">
                <textarea id="content" name="content">{{ old('content') }}</textarea>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Thumbnail</label>
              <div class="col-sm-12 col-md-10">
                <div id="image-preview" class="image-preview">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="image" id="image-upload" />
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Tag</label>
              <div class="col-sm-12 col-md-10">
                <select class="form-control select2" name="tags[]" multiple="multiple">
                  @foreach ($tags as $id => $title)
                    <option @if (old('tags') && in_array($id, (old('tags')))) selected @endif
                      value="{{ $id }}">{{ $title }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Status</label>
              <div class="col-sm-12 col-md-10">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
                  <label class="form-check-label" for="status1">
                    PUBLISH
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status2" value="0">
                  <label class="form-check-label" for="status2">
                    PENDING
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
              <div class="col-sm-12 col-md-10">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <link href="{{ asset('assets/stisla/modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@push('scripts')
  <script src="{{ asset('assets/stisla/js/uploadPreview.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script>
    $(function() {
      $('.select2').select2({

      });
      $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Choose Image", // Default: Choose File
        label_selected: "Change Image", // Default: Change File
        no_label: false // Default: false
      });

      $('#content').summernote({
        placeholder: 'Write your content here...',
        height: 300,
        dialogsInBody: true
      })
    })

  </script>
@endpush

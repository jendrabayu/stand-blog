<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Home') &mdash; Stand Blog</title>

  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/components.css') }}">
  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <nav class="navbar navbar-expand-lg main-navbar">
        @include('includes.dashboard.topnav')
      </nav>

      <div class="main-sidebar">
        @include('includes.dashboard.sidebar')
      </div>

      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>

      <footer class="main-footer">
        @include('includes.dashboard.footer')
      </footer>
    </div>
  </div>

  <script src="{{ asset('assets/stisla/js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --}}
  @stack('scripts')
</body>

</html>

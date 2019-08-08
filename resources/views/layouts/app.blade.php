<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title', config('app.name'))</title>
      <meta name="description" content="@yield('meta_description', 'Clinical Managment')">
      <meta name="author" content="@yield('meta_author', 'Pyae Sone')">

      @yield('meta')
        <link rel="stylesheet" href="{{ asset('css/template/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/variable.css') }}">
      @stack('styles')
    </head>
      @if (request()->route()->getName() != "login")
        <body class="skin-blue fixed-layout">
          @include('includes.preloader')
          @include('includes.nav')
          @include('includes.sidebar')

          <!-- ============================================================== -->
          <!-- Page wrapper  -->
          <!-- ============================================================== -->
<<<<<<< HEAD
            <div class="page-wrapper">
              <!-- ============================================================== -->
              <!-- Container fluid  -->
              <!-- ============================================================== -->
              <div class="container-fluid">
                @yield('content')
              </div>
            </div>
            <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/perfect-scrollbar.jquery.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/waves.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/sidebarmenu.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/custom.min.js') }}"></script>
            @stack('scripts')
          </body>  
        @else
        <body class="skin-default card-no-border">
          @include('includes.preloader')
          @yield('content')
          <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
          <script type="text/javascript" src="{{ asset('/js/template/perfect-scrollbar.jquery.min.js') }}"></script>
          <script type="text/javascript" src="{{ asset('/js/waves.js') }}"></script>
          <script type="text/javascript" src="{{ asset('/js/template/custom.min.js') }}"></script>
        </body>
        @endif
=======
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
        <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/template/perfect-scrollbar.jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/waves.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/template/sidebarmenu.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/template/custom.min.js') }}"></script>

        @stack('scripts')
    </body>
>>>>>>> hospital_CRUD
  </html>

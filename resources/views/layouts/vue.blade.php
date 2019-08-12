<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title', config('app.name'))</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="description" content="@yield('meta_description', 'Clinical Managment')">
      <meta name="author" content="@yield('meta_author', 'Pyae Sone')">

      @yield('meta')
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/template/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template/style.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="{{ asset('css/template/variable.css') }}">
      @stack('styles')
    </head>
    <body class="skin-blue fixed-layout">
      @include('includes.preloader')
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
            @yield('content')
            <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/perfect-scrollbar.jquery.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/waves.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/sidebarmenu.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/template/custom.min.js') }}"></script>
            <script>
            </script>
    </body>
  </html>

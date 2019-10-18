<!DOCTYPE html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Styles -->
  <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="h-100">
<div id="app" class="d-flex flex-column h-100">
  <header>

    @include('partials.top-navbar')
  </header>

  <main>

    @section('breadcrumbs', Breadcrumbs::render())
    @yield('breadcrumbs')
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-2">

          @include('backend.left-sidebar')
        </div>
        <div class="col-10">

          @yield('content')
        </div>
      </div>
    </div>

  </main>

  <footer class="mt-auto">

    @include('partials.footer')
  </footer>
</div>
<script src="{{ mix('js/app.js', 'build') }}"></script>
@yield('script')
@include('partials.alerts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  <div class="d-flex justify-content-center my-4">
    <a href="{{ url("/") }}">
      <img src="{{ asset('storage/images/tank-wagon.png') }}" width="48" class="">
    </a>
  </div>
  <h2 class="text-center">Учет задержанных и длительно простаивающих вагонов</h2>

  @yield('content')
</div>
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>


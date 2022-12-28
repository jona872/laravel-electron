<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <title>Facturas</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- IMPORTANTE -->
   <link rel="stylesheet" href="{{ asset('css/layout.css')}}">

   @stack('styles')

</head>

<body>
   @include('components.navbar')
   <!-- CONTENT -->
   <main class="main">
      @yield('content')

   </main>
   <!-- CONTENT -->

   @stack('scripts')
   <!-- <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script> -->
</body>

</html>
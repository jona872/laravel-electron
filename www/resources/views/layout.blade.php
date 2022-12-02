<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <title>Facturas</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   
   <!-- IMPORTANTE -->
   <!-- <link rel="stylesheet" href="{{ asset('css/picker.css')}}"> -->
   <link rel="stylesheet" href="{{ asset('css/layout.css')}}">
   @stack('styles')

</head>

<body class="app">

   <!-- CONTENT -->
   <main class="main">
      <div id="app" class="">
         @yield('content')
      </div>
   </main>
   <!-- CONTENT -->


   @yield('scripts')
   <!-- <script src="{{ asset('js/admin.js') }}"></script> -->
   <!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
   

</body>

</html>
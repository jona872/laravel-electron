<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <title>Facturas</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   

   <!-- IMPORTANTE -->   
   <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/layout.css')}}">
   <!-- <link rel="stylesheet" href="https://unpkg.com/jquery-resizable-columns@0.2.3/dist/jquery.resizableColumns.css">    -->
  

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
   
   <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
   <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <!-- <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script> -->
   <!-- <script src="{{ asset('js/jquery.resizableColumns.js') }}"></script> -->
   
</body>

</html>
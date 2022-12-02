<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <title>Facturas</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- <script src="{{ asset('js/app.js') }}"></script> -->


   <!-- IMPORTANTE -->
   <!-- <link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/font/bootstrap-icons.css')}}"> -->
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
   <!-- <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/aos.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/scrollax.min.js') }}"></script> -->

   <!-- <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script> -->

   <!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
   

</body>

</html>
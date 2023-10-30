@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">

@endpush

@section('content')


<div class=".container-fluid">
  <h2 class="">Ingresar al sistema</h2>

  <form method="POST" action="{{ route('login') }}" class="card p-3">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf

    <div class="row text-center">
      <!-- //EMAIl -->
      <div class="mb-3 row">
        <label for="email" class="col-sm-3 col-form-label">E-Mail</label>
        <div class="col-sm-9">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" title="Por favor complete este campo" required>
          @error('email')
          <span class="" role="alert"> <strong>{{ $message }}</strong> </span>
          @enderror
        </div>
      </div>
      <!-- Password -->
      <div class="mb-3 row">
        <label for="password" class="col-sm-3 col-form-label">Contraseña</label>
        <div class="col-sm-9">
          <input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" required title="Por favor complete este campo">
          @error('password')
          <span class="" role="alert"> <strong>{{ $message }}</strong> </span>
          @enderror
        </div>
      </div>
    </div>

    <!-- RememberMe -->
    <div class="col-md-12">
      
      <div class="d-block sm-text-center">
        <input class="col-sm-3" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">
        <label class="col-sm-8 " for="remember"> Recordarme </label>
      </div>
    </div>

    <!-- Buttons -->
    <div class="row text-center">
      <div>
        <button type="submit" class="btn btn-primary"> Entrar </button>
        @if (Route::has('register'))
        <a class="btn btn-danger" href="{{ route('register') }}">{{ __('Registrar') }}</a>
        @endif
      </div>
    </div>



  </form>
</div>


@endsection
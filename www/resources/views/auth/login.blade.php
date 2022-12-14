@extends('layout')

@section('content')


<div class="card m-top-10vh">
  <div class="card--row">
    <h2>Ingresar al sistema</h2>
  </div>

  <form method="POST" action="{{ route('login') }}" class="card--form">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf

    <div class="card--row">
      <label for="email" class="card--row--item card--label">E-Mail</label>

      <div class="card--row--item card--input">
        <input id="email" type="email" name="email" value="{{ old('email') }}" required title="Por favor complete este campo">
        @error('email')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="password" class="card--row--item card--label">Contraseña</label>

      <div class="card--row--item card--input">
        <input id="password" type="password" name="password" value="{{ old('password') }}" required title="Por favor complete este campo">
        @error('password')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <input class="card--label" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">
      <label class="card--input" for="remember"> Recordarme </label>
    </div>

    
    <div class="card--row">
      <div class="card--row--item card--label">
        <button type="submit" class="btn btn--confirm"> Entrar </button>
      </div>
      @if (Route::has('register'))
      <div class="card--row--item card--input">
        <a class="btn btn--cancel a--btn" href="{{ route('register') }}">{{ __('Registrar') }}</a>
      </div>
      @endif
    </div>




  </form>
</div>

@endsection
@extends('layout')

@section('content')


<div class="card">
  <div class="card--row">
    <h2>Ingresar al sistema</h2>
  </div>

  <form method="POST" action="{{ route('login') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
    <div class="card--row">
      <label for="email" class="card--row--item card--label">E-Mail</label>

      <div class="card--row--item card--input">
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="password" class="card--row--item card--label">Contraseña</label>

      <div class="card--row--item card--input">
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
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
        <button type="submit" class="card--btn"> Entrar </button>
      </div>
      @if (Route::has('register'))
      <div class="card--row--item card--input">
        <button class="card--btn">
          <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </button>
      </div>
      @endif

    </div>

  </form>
</div>

@endsection
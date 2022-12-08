@extends('layout')

@section('content')

<div class="card">
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="card--row">
      <label for="name" class="card--row--item card-label">Nombre</label>

      <div class="card--row--item card-input">
        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>


    <div class="card--row">
      <label for="email" class="card--row--item card-label">E-Mail</label>

      <div class="card--row--item card-input">
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="password" class="card--row--item card-label">Password</label>

      <div class="card--row--item card-input">
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
        @error('password')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>


    <div class="card--row">
      <label for="password-confirm" class="card--row--item card-label">Confirmar Password</label>

      <div class="card--row--item card-input">
        <input id="password-confirm" type="password" class="@error('password-confirm') is-invalid @enderror" name="password-confirm" value="{{ old('password-confirm') }}" required autocomplete="password-confirm" autofocus>
        @error('password-confirm')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="cuit" class="card--row--item card-label">CUIT</label>

      <div class="card--row--item card-input">
        <input id="cuit" type="text" class="@error('cuit') is-invalid @enderror" name="cuit" value="{{ old('cuit') }}" required autocomplete="cuit" autofocus>
        @error('cuit')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="condition" class="card--row--item card-label">Condicion</label>

      <div class="card--row--item card-input">
        <input id="condition" type="text" class="@error('condition') is-invalid @enderror" name="condition" value="{{ old('condition') }}" required autocomplete="condition" autofocus>
        @error('condition')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="direction" class="card--row--item card-label">Direccion</label>

      <div class="card--row--item card-input">
        <input id="direction" type="text" class="@error('direction') is-invalid @enderror" name="direction" value="{{ old('direction') }}" required autocomplete="direction" autofocus>
        @error('direction')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="activity_start" class="card--row--item card-label">Inicio de Actividades</label>

      <div class="card--row--item card-input">
        <input id="activity_start" type="text" class="@error('activity_start') is-invalid @enderror" name="activity_start" value="{{ old('activity_start') }}" required autocomplete="activity_start" autofocus>
        @error('activity_start')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="gross_receipts_tax" class="card--row--item card-label">Ingresos Brutos</label>

      <div class="card--row--item card-input">
        <input id="gross_receipts_tax" type="text" class="@error('gross_receipts_tax') is-invalid @enderror" name="gross_receipts_tax" value="{{ old('gross_receipts_tax') }}" required autocomplete="gross_receipts_tax" autofocus>
        @error('gross_receipts_tax')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>



    <div class="card--row">
      <div class="card--row--item card--btn">
        <button type="submit">
          Registrar
        </button>
      </div>
    </div>

  </form>

</div>

@endsection
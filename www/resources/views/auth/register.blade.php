@extends('layout')

@section('content')



<h1 class="title--header">
  <a href="/" role="button" class="row--centered">
    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
    </svg>
    <span>Volver</span>
  </a>
</h1>

<div class="card m-top-5vh">
  <div class="card--row">
    <h2>Registrar Nuevo Usuario</h2>
  </div>

  <form method="POST" action="{{ route('register') }}" class="card--form">
    @csrf

    <!-- autocomplete="off" -->
    <div class="card--row">
      <label for="name" class="card--row--item card--label">Nombre</label>

      <div class="card--row--item card-input">
        <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus title="Por favor complete este campo">
        @error('name')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="email" class="card--row--item card--label">E-Mail</label>

      <div class="card--row--item card-input">
        <input id="email" type="text" name="email" value="{{ old('email') }}" title="Por favor complete este campo">
        @error('email')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>



    <div class="card--row">
      <label for="password" class="card--row--item card--label">Password</label>

      <div class="card--row--item card-input">
        <input id="password" type="password" name="password" value="{{ old('password') }}" autocomplete="password" title="Por favor complete este campo" />
        @error('password')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>


    <div class="card--row">
      <label for="password-confirm" class="card--row--item card--label">{{ __('Confirm Password') }}</label>

      <div class="card--row--item card-input">
        <input id="password-confirm" type="password" name="password_confirmation" value="{{ old('password-confirm') }}" autocomplete="password-confirm" title="Por favor complete este campo" />
        @error('password-confirm')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>






    <div class="card--row">
      <label for="cuit" class="card--row--item card--label">CUIT</label>

      <div class="card--row--item card-input">
        <input id="cuit" type="text" name="cuit" value="{{ old('cuit') }}" autocomplete="cuit" title="Por favor complete este campo">
        @error('cuit')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="condition" class="card--row--item card--label">Condicion</label>

      <div class="card--row--item card-input">
        <input id="condition" type="text" name="condition" value="{{ old('condition') }}" autocomplete="condition" title="Por favor complete este campo">
        @error('condition')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="direction" class="card--row--item card--label">Direccion</label>

      <div class="card--row--item card-input">
        <input id="direction" type="text" name="direction" value="{{ old('direction') }}" autocomplete="direction" title="Por favor complete este campo">
        @error('direction')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="activity_start" class="card--row--item card--label">Inicio de Actividades</label>

      <div class="card--row--item card-input">
        <input id="activity_start" type="text" name="activity_start" value="{{ old('activity_start') }}" autocomplete="activity_start" title="Por favor complete este campo">
        @error('activity_start')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="card--row">
      <label for="gross_receipts_tax" class="card--row--item card--label">Ingresos Brutos</label>

      <div class="card--row--item card-input">
        <input id="gross_receipts_tax" type="text" name="gross_receipts_tax" value="{{ old('gross_receipts_tax') }}" autocomplete="gross_receipts_tax" title="Por favor complete este campo">
        @error('gross_receipts_tax')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>



    <div class="card--row">
      <div class="card--row--item card--center--btn">
        <!-- <button type="submit" class="card--btn">
          Registrar
        </button> -->
        <button type="submit" class="btn btn--confirm"> Registrar </button>
      </div>
    </div>


    

  </form>

</div>

@endsection
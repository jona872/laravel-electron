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



<div class=".container-fluid mx-auto">
  <h2>Registrar Nuevo Usuario</h2>
  <form method="POST" action="{{ route('register') }}" class="card p-3">
    @csrf

    <!-- autocomplete="off" -->
    <div class="row mb-1">
      <label for="name" class="col-form-label">Nombre</label>

      <div class="col">
        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" autofocus title="Por favor complete este campo">
        @error('name')
        <span class="invalid" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="email" class="col-form-label">E-Mail</label>

      <div class="col">
        <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" title="Por favor complete este campo">
        @error('email')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="password" class="col-form-label">Password</label>

      <div class="col">
        <input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" autocomplete="password" title="Por favor complete este campo" />
        @error('password')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

      <div class="col">
        <input id="password-confirm" class="form-control" type="password" name="password_confirmation" value="{{ old('password-confirm') }}" autocomplete="password-confirm" title="Por favor complete este campo" />
        @error('password-confirm')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>


    <div class="row mb-1">
      <label for="cuit" class="col-form-label">CUIT</label>

      <div class="col">
        <input id="cuit" class="form-control" type="text" name="cuit" value="{{ old('cuit') }}" autocomplete="cuit" title="Por favor complete este campo">
        @error('cuit')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="condition" class="col-form-label">Condicion</label>

      <div class="col">
        <input id="condition" class="form-control" type="text" name="condition" value="{{ old('condition') }}" autocomplete="condition" title="Por favor complete este campo">
        @error('condition')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="direction" class="col-form-label">Direccion</label>

      <div class="col">
        <input id="direction" class="form-control" type="text" name="direction" value="{{ old('direction') }}" autocomplete="direction" title="Por favor complete este campo">
        @error('direction')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="activity_start" class="col-form-label">Inicio de Actividades</label>

      <div class="col">
        <input id="activity_start" class="form-control" type="text" name="activity_start" value="{{ old('activity_start') }}" autocomplete="activity_start" title="Por favor complete este campo">
        @error('activity_start')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row mb-1">
      <label for="gross_receipts_tax" class="col-form-label">Ingresos Brutos</label>

      <div class="col">
        <input id="gross_receipts_tax" class="form-control" type="text" name="gross_receipts_tax" value="{{ old('gross_receipts_tax') }}" autocomplete="gross_receipts_tax" title="Por favor complete este campo">
        @error('gross_receipts_tax')
        <span class="invalid" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="d-grid mt-2">
        <button type="submit" class="btn btn-primary"> Registrar </button>
    </div>

  




  </form>

</div>



@endsection
@extends('layout')

@section('content')


<div class=".container-fluid mx-auto">
  <h2>Generar Resumen Anual</h2>
  <form action="{{url('/anuales/preview')}}" method="POST" class="card p-3">
    @csrf

    <div class="row mb-3">
      <div class="col mb-1">
        <input type="radio" id="compras" name="operatoria" value="compras" checked>
        <label for="compras">Compras</label>
      </div>
      <div class="col mb-1">
        <input type="radio" id="ventas" name="operatoria" value="ventas">
        <label for="ventas">Ventas</label>
      </div>
    </div>

    <div class="row mb-3">

      <label for="year" class="col-form-label">Ingrese el Año:</label>
      <div class="col">
        <input class="form-control" id="year" type="number" name="year" value="{{now()->year}}" required autocomplete="year" oninvalid="this.setCustomValidity('Esta campo en requerido!')">
        @error('year')
        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
        @enderror
      </div>
    </div>

    <div class="row text-center mt-3">
      <div class="d-flex justify-content-center gap-2 flex-wrap">
        <button type="submit" class="btn btn-primary"> Continuar </button>
      </div>
    </div>

  </form>

</div>


@endsection
@extends('layout')

@section('content')


<div class="mx-auto">
<h2 class="my-3">Generar Resumen Mensual</h2>
    <!-- <form action="{{ route('clientes.store') }}" method="POST" class="card--form"> -->
    <form action="{{url('/mensuales/preview')}}" method="POST" class="card p-3">
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

        <div class="row mb-3">
            <label for="mes" class="col-form-label">Ingrese el mes:</label>

            <div class="col">
                <input class="form-control" id="mes" type="number" name="mes" value="{{ old('mes') }}" required autocomplete="mes" oninvalid="this.setCustomValidity('Esta campo en requerido!')">
                @error('mes')
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
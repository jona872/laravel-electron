@extends('layout')

@section('content')

<main class="main">
    <div class="container">
        <!-- <form action="{{ route('clientes.store') }}" method="POST" class="card--form"> -->
        <form action="{{url('/mensuales/preview')}}" method="POST" class="card--form">
            @csrf

            <div class="card--row row--centered evenly">
                <div>
                    <input type="radio" id="compras" name="operatoria" value="compras" checked>
                    <label for="compras">Compras</label>
                </div>
                <div>
                    <input type="radio" id="ventas" name="operatoria" value="ventas">
                    <label for="ventas">Ventas</label>
                </div>
            </div>

            <div class="card--row">
                
                <label for="year" class="card--row--item card--label">Ingrese el Año:</label>
                <div class="card--row--item card-input">
                    <input id="year" type="number" name="year" value="{{now()->year}}" required autocomplete="year" oninvalid="this.setCustomValidity('Esta campo en requerido!')">
                    @error('year')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>

            <div class="card--row">
                <label for="mes" class="card--row--item card--label">Ingrese el mes:</label>

                <div class="card--row--item card-input">
                    <input id="mes" type="number" name="mes" value="{{ old('mes') }}" required autocomplete="mes" oninvalid="this.setCustomValidity('Esta campo en requerido!')">
                    @error('mes')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>


            <div class="card--row">
                <div class="row--centered">
                    <button type="submit" class="btn btn--confirm"> Continuar </button>
                </div>
            </div>


        </form>

    </div>
</main>


@endsection
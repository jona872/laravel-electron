@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/clientes.css')}}">
@endpush

@section('content')
<h1 class="title--header">
    <a href="/" role="button" class="row--centered">
        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        <span>Clientes</span>
    </a>
</h1>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
    <form action="{{ route('clientes.update',$cliente->id) }}" method="POST" class="card--form">
        @csrf
        @method('PUT')
        <input name="id" type="hidden" value="{{ $cliente->id }}">

        <div class="card--row">
            <h2>Editando Cliente</h2>
        </div>

        @if ($errors->any())
        <div class="invalid-feedback">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card--row">
            <label for="name" class="card--row--item card--label">Nombre del Cliente</label>

            <div class="card--row--item card-input">
                <input id="name" type="text" name="name" value="{{$cliente->name}}" autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
            <label for="cuit" class="card--row--item card--label">CUIT</label>

            <div class="card--row--item card-input">
                <input id="cuit" type="text" name="cuit" value="{{$cliente->cuit}}" autocomplete="cuit" autofocus>
                @error('cuit')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
            <label for="condition" class="card--row--item card--label">Condicion</label>

            <div class="card--row--item card-input">
                <input id="condition" type="text" name="condition" value="{{$cliente->condition}}" autocomplete="condition" autofocus>
                @error('condition')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
            <label for="direction" class="card--row--item card--label">Direccion</label>

            <div class="card--row--item card-input">
                <input id="direction" type="text" name="direction" value="{{$cliente->direction}}" autocomplete="direction" autofocus>
                @error('direction')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
            <label for="activity_start" class="card--row--item card--label">Inicio de Actividades</label>

            <div class="card--row--item card-input">
                <input id="activity_start" type="text" name="activity_start" value="{{$cliente->activity_start}}" autocomplete="activity_start" autofocus>
                @error('activity_start')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
            <label for="gross_receipts_tax" class="card--row--item card--label"> Ingresos Brutos </label>

            <div class="card--row--item card-input">
                <input id="gross_receipts_tax" type="text" name="gross_receipts_tax" value="{{$cliente->gross_receipts_tax}}" autocomplete="gross_receipts_tax" autofocus>
                @error('gross_receipts_tax')
                <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="card--row">
			<div class="card--row--item card--label">
				<a class="btn btn--cancel a--btn" href="{{ route('clientes.index') }}">{{ __('Cancelar') }}</a>
			</div>

			<div class="card--row--item card--input">
				<button type="submit" class="btn btn--confirm"> Guardar </button>
			</div>
		</div>

    </form>

    @endsection
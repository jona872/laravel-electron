@extends('layout')
@push('styles')
<!-- <link rel="stylesheet" href="{{ asset('css/clientes.css')}}"> -->
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

<div class="mx-auto">
    <form action="{{ route('clientes.update',$cliente->id) }}" method="POST" class="card p-3">
        @csrf
        @method('PUT')
        <input name="id" type="hidden" value="{{ $cliente->id }}">
        <h2>Editando Cliente</h2>

        @if ($errors->any())
        <div class="invalid">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row mb-1">
            <label for="name" class="col-form-label">Nombre del Cliente</label>

            <div class="col">
                <input required class="form-control" id="name" type="text" name="name" value="{{$cliente->name}}" autocomplete="name" autofocus>
                @error('name')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <label for="cuit" class="col-form-label">CUIT</label>

            <div class="col">
                <input required class="form-control" id="cuit" type="text" name="cuit" value="{{$cliente->cuit}}" autocomplete="cuit" autofocus>
                @error('cuit')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <label for="condition" class="col-form-label">Condicion</label>

            <div class="col">
                <input required class="form-control" id="condition" type="text" name="condition" value="{{$cliente->condition}}" autocomplete="condition" autofocus>
                @error('condition')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <label for="direction" class="col-form-label">Direccion</label>

            <div class="col">
                <input class="form-control" id="direction" type="text" name="direction" value="{{$cliente->direction}}" autocomplete="direction" autofocus>
                @error('direction')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <label for="activity_start" class="col-form-label">Inicio de Actividades</label>

            <div class="col">
                <input class="form-control" id="activity_start" type="text" name="activity_start" value="{{$cliente->activity_start}}" autocomplete="activity_start" autofocus>
                @error('activity_start')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <label for="gross_receipts_tax" class="col-form-label"> Ingresos Brutos </label>

            <div class="col">
                <input class="form-control" id="gross_receipts_tax" type="text" name="gross_receipts_tax" value="{{$cliente->gross_receipts_tax}}" autocomplete="gross_receipts_tax" autofocus>
                @error('gross_receipts_tax')
                <span class="invalid" role="alert"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="row text-center mt-2">
            <div class="d-flex justify-content-center g-2 flex-wrap">

                <a class="btn btn-danger" href="{{ route('clientes.index') }}">{{ __('Cancelar') }}</a>

                <button type="submit" class="btn btn-primary"> Guardar </button>
            </div>
        </div>

    </form>

    @endsection
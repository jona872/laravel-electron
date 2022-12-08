@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/clientes.css')}}">
@endpush

@section('content')

<main class="main">
    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h1>
            <a href="/" role="button" class="header-btn header-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                </svg>Clientes
            </a>
        </h1>


        <div class="container-xl">
            <div class="card">
                <form action="{{ route('clientes.update',$cliente->id) }}" method="POST" class="form-horizontal form-create">
                    @csrf
                    @method('PUT')
                    <input name="id" type="hidden" value="{{ $cliente->id }}">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> CREAR CLIENTE para el usuario: {{ Auth::user()->name }}
                    </div>

                    <div class="card-body">

                        <div class="form-group row align-items-center has-success">
                            <label for="name" class="col-form-label text-md-right col-md-3">
                                <strong> Nombre del Cliente </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="name" name="name" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->name}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center has-success">
                            <label for="cuit" class="col-form-label text-md-right col-md-3">
                                <strong> CUIT </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="cuit" name="cuit" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->cuit}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center has-success">
                            <label for="condition" class="col-form-label text-md-right col-md-3">
                                <strong> Condicion </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="condition" name="condition" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->condition}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center has-success">
                            <label for="direction" class="col-form-label text-md-right col-md-3">
                                <strong> Direccion </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="direction" name="direction" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->direction}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center has-success">
                            <label for="activity_start" class="col-form-label text-md-right col-md-3">
                                <strong> Inicio de Actividades </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="activity_start" name="activity_start" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->activity_start}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center has-success">
                            <label for="gross_receipts_tax" class="col-form-label text-md-right col-md-3">
                                <strong> Ingresos Brutos </strong>
                            </label>
                            <div class="col-md-9 col-xl-7">
                                <input type="text" id="gross_receipts_tax" name="gross_receipts_tax" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{$cliente->gross_receipts_tax}}">
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-danger" href="{{ route('clientes.index') }}">
                                <i class="fa fa-ban"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-download"></i> Guardar
                            </button>
                        </div>


                    </div>
                </form>
            </div>
</main>


@endsection
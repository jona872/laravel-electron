@extends('layout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif




<div class="container-xl">
    <div class="card">
        <form action="{{ route('clientes.store') }}" method="POST" class="form-horizontal form-create">
            @csrf
            <div class="card-header">
                <i class="fa fa-plus"></i> CREAR CLIENTE para el usuario:  {{ Auth::user()->name }}  
            </div>

			<div class="card-body">

            <div class="form-group row align-items-center has-success">
					<label for="name" class="col-form-label text-md-right col-md-3">
						<strong> Nombre del Cliente </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="name" name="name" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="Cliente">
					</div>
				</div>
                
				<div class="form-group row align-items-center has-success">
					<label for="cuit" class="col-form-label text-md-right col-md-3">
						<strong> CUIT </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="cuit" name="cuit" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="12-35706608-1">
					</div>
				</div>
                
                <div class="form-group row align-items-center has-success">
					<label for="condition" class="col-form-label text-md-right col-md-3">
						<strong> Condicion </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="condition" name="condition" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="Inscripto">
					</div>
				</div>
            
                <div class="form-group row align-items-center has-success">
					<label for="direction" class="col-form-label text-md-right col-md-3">
						<strong> Direccion </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="direction" name="direction" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="Av. Almafuertes 4777">
					</div>
				</div>

                <div class="form-group row align-items-center has-success">
					<label for="activity_start" class="col-form-label text-md-right col-md-3">
						<strong> Inicio de Actividades </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="activity_start" name="activity_start" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="12/12/2020">
					</div>
				</div>

                <div class="form-group row align-items-center has-success">
					<label for="gross_receipts_tax" class="col-form-label text-md-right col-md-3">
						<strong> Ingresos Brutos </strong>
					</label>
					<div class="col-md-9 col-xl-7">
						<input type="text" id="gross_receipts_tax" name="gross_receipts_tax" class="form-control form-control-success" aria-required="true" aria-invalid="false" value="{{ Auth::user()->name }}">
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


		@endsection
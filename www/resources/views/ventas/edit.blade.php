@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/buckup/smoothness/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/buckup/form.css') }}">
@endpush

@section('content')

<h1 class="title--header">
   <a href="/ventas" role="button" class="row--centered">
      <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
      </svg>
      <span>Ventas</span>
   </a>
</h1>

<form action="{{ route('ventas.update',$venta->id) }}" method="POST" class="card--form">
   @csrf
   @method('PUT')
   <input name="id" type="hidden" value="{{ $venta->id }}">

   <div class="container">

      <div class="left--panel">
         <div class="form--row">
            <label for="fecha"> Fecha </label>
            <input id="fecha" type="text" name="fecha" value="{{ $venta->fecha }}" />
         </div>

         <div class="form--row">
            <label for="pto_venta"> Pto de Venta </label>
            <input id="pto_venta" type="text" name="pto_venta" value="{{ $venta->pto_venta }}" />
         </div>

         <div class="form--row">
            <label for="codigo_comprobante"> Nro Comprobante </label>
            <input id="codigo_comprobante" type="text" name="codigo_comprobante" value="{{ $venta->codigo_comprobante }}" />
         </div>

         <div class="form--row">
            <label for="tipo_comprobante"> Tipo de Comprobante </label>
            <select name="tipo_comprobante" id="tipo_comprobante">
               <option selected="selected"> {{ $venta->tipo_comprobante }} </option>
               <option value="Otros">Otros</option>
               <option value="Factura A">Factura A</option>
               <option value="Factura B">Factura B</option>
               <option value="Factura C">Factura C</option>
            </select>
         </div>

         <div class="form--row">
            <label for="client_id"> Codigo Cliente </label>
            <input id="client_id" type="text" name="client_id" value="{{ $cliente->id }}" />
         </div>
         <div class="form--row">
            <label for="name"> Nombre Cliente </label>
            <input id="name" type="text" name="name" value="{{ $cliente->name }}" />
         </div>
         <div class="form--row">
            <label for="cuit"> CUIT </label>
            <input id="cuit" type="text" name="cuit" value="{{ $cliente->cuit }}" />
         </div>
         <div class="form--row">
            <label for="condition"> Condicion </label>
            <input id="condition" type="text" name="condition" value="{{ $cliente->condition }}" />
         </div>
      </div>

      <div class="right--panel">
         <div class="form--row">
            <label for="neto"> Neto </label>
            <input id="neto" type="number" name="neto" step='0.01' value="{{ $venta->neto }}" />
         </div>
         <div class="form--row">
            <label for="iva"> I.V.A. </label>
            <input id="iva" type="number" name="iva" step='0.01' value="{{ $venta->iva }}" />
         </div>
         <div class="form--row">
            <label for="iva_liquidado"> I.V.A. Liquidado </label>
            <input id="iva_liquidado" type="number" name="iva_liquidado" step='0.01' value="{{ $venta->iva_liquidado }}" />
         </div>
         <div class="form--row">
            <label for="iva_sobretasa"> Sobre Ta. I.V.A. </label>
            <input id="iva_sobretasa" type="number" name="iva_sobretasa" step='0.01' value="{{ $venta->iva_sobretasa }}" />
         </div>
         <div class="form--row">
            <label for="percepcion"> Percepcion </label>
            <input id="percepcion" type="number" name="percepcion" step='0.01' value="{{ $venta->percepcion }}" />
         </div>
         <div class="form--row">
            <label for="iva_retencion"> I.V.A. Retencion </label>
            <input id="iva_retencion" type="number" name="iva_retencion" step='0.01' value="{{ $venta->iva_retencion }}" />
         </div>
         <div class="form--row">
            <label for="conceptos_no_gravados"> Conceptos No Gravados </label>
            <input id="conceptos_no_gravados" type="number" name="conceptos_no_gravados" step='0.01' value="{{ $venta->conceptos_no_gravados }}" />
         </div>
         <div class="form--row">
            <label for="ingresos_exentos"> Ingresos Exentos </label>
            <input id="ingresos_exentos" type="number" name="ingresos_exentos" step='0.01' value="{{ $venta->ingresos_exentos }}" />
         </div>
         <div class="form--row">
            <label for="ganancias_retencion"> Retencion de Ganancias </label>
            <input id="ganancias_retencion" type="number" name="ganancias_retencion" step='0.01' value="{{ $venta->ganancias_retencion }}" />
         </div>

         <div class="form--row">
            <label for="total"> Total </label>
            <input id="total" type="text" step="any" name="total" value="{{ $venta->total }}" />
         </div>
         <div class="form--row">
            <label for="tipo_op"> Tipo de Operacion </label>
            <input id="tipo_op" type="text" step="any" name="tipo_op" value="{{ $venta->tipo_op }}" />
         </div>
         <div class="form--row mt-2">
        <div class="invisible">.</div>
        <button type="button" class="btn btn-outline-danger" id="limpiar">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
            <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"></path>
          </svg>
          Limpiar Campos
        </button>

      </div>
      </div>
   </div>

      <div class="row text-center mt-3">
         <div class="d-flex justify-content-center g-2 flex-wrap">
            <a class="btn btn-danger" href="{{ route('ventas.index') }}">{{ __('Cancelar') }}</a>

            <button class="btn btn-primary" type="submit"> Guardar </button>
         </div>
      </div>

</form>


@endsection

@push('scripts')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/handleFormVentas.js') }}"></script>
@endpush
@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/compras.css')}}">
@endpush

@section('content')

<h1 class="title--header">
    <a href="/compras" role="button" class="row--centered">
        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        <span>Ventas</span>
    </a>
</h1>

<form action="{{ route('compras.update',$compra->id) }}" method="POST" class="card--form">
    @csrf
    @method('PUT')
    <input name="id" type="hidden" value="{{ $compra->id }}">
    <div>
        <label for="fecha"> Fecha </label>
        <input id="fecha" type="text" name="fecha" value="{{ $compra->fecha }}" />
    </div>

    <div>
        <label for="pto_compra"> Pto de Venta </label>
        <input id="pto_compra" type="text" name="pto_compra" value="{{ $compra->pto_compra }}" />
    </div>

    <div>
        <label for="codigo"> Nro Comprobante </label>
        <input id="codigo" type="text" name="codigo" value="{{ $compra->codigo }}" />
    </div>

    <div>
        <label for="tipo_comprobante"> Tipo de Comprobante </label>
        <select name="tipo_comprobante" id="tipo_comprobante">
            <option selected="selected"> {{ $compra->tipo_comprobante }} </option>
            <option value="Otros">Otros</option>
            <option value="Factura A">Factura A</option>
            <option value="Factura B">Factura B</option>
            <option value="Factura C">Factura C</option>
        </select>
    </div>
    <br>
    <hr>
    <br>
    <div>
        <label for="codigo"> Codigo Cliente </label>
        <input id="codigo" type="text" name="codigo" value="{{ $compra->codigo }}" />
    </div>
    <div>
        <label for="nombre"> Nombre Cliente </label>
        <input id="nombre" type="text" name="nombre" value="{{ $compra->nombre }}" />
    </div>
    <div>
        <label for="cuit"> CUIT </label>
        <input id="cuit" type="text" name="cuit" value="{{ $compra->cuit }}" />
    </div>
    <div>
        <label for="condicion"> Condicion </label>
        <input id="condicion" type="text" name="condicion" value="{{ $compra->condicion }}" />
    </div>
    <br>
    <hr>
    <br>
    <div>
        <label for="neto"> Neto </label>
        <input id="neto" type="text" name="neto" value="{{ $compra->neto }}" />
    </div>
    <div>
        <label for="iva"> I.V.A. </label>
        <input id="iva" type="text" name="iva" value="{{ $compra->iva }}" />
    </div>
    <div>
        <label for="iva_liquidado"> I.V.A. Liquidado </label>
        <input id="iva_liquidado" type="text" name="iva_liquidado" value="{{ $compra->iva_liquidado }}" />
    </div>
    <div>
        <label for="iva_sobretasa"> Sobre Ta. I.V.A. </label>
        <input id="iva_sobretasa" type="text" name="iva_sobretasa" value="{{ $compra->iva_sobretasa }}" />
    </div>
    <div>
        <label for="percepcion"> Percepcion </label>
        <input id="percepcion" type="text" name="percepcion" value="{{ $compra->percepcion }}" />
    </div>
    <div>
        <label for="iva_retencion"> I.V.A. Retencion </label>
        <input id="iva_retencion" type="text" name="iva_retencion" value="{{ $compra->iva_retencion }}" />
    </div>
    <div>
        <label for="conceptos_no_gravados"> Conceptos No Gravados </label>
        <input id="conceptos_no_gravados" type="text" name="conceptos_no_gravados" value="{{ $compra->conceptos_no_gravados }}" />
    </div>
    <div>
        <label for="ingresos_exentos"> Ingresos Externos </label>
        <input id="ingresos_exentos" type="text" name="ingresos_exentos" value="{{ $compra->ingresos_exentos }}" />
    </div>
    <div>
        <label for="ganancias_retencion"> Retencion de Ganancias </label>
        <input id="ganancias_retencion" type="text" name="ganancias_retencion" value="{{ $compra->ganancias_retencion }}" />
    </div>
    <br>
    <hr>
    <br>
    <div>
        <label for="total"> Total </label>
        <input id="total" type="text" step="any" name="total" value="{{ $compra->total }}" />
    </div>
    <div>
        <label for="tipo_op"> Tipo de Operacion </label>
        <input id="tipo_op" type="text" step="any" name="tipo_op" value="{{ $compra->tipo_op }}" />
    </div>

    <div class="card--row">
        <a class="btn btn--cancel a--btn" href="{{ route('compras.index') }}">{{ __('Cancelar') }}</a>

        <button type="submit" class="btn btn--confirm"> Guardar </button>
    </div>

</form>


@endsection
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
        <span>Compras</span>
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
        <label for="pto_venta"> Pto de Venta </label>
        <input id="pto_venta" type="text" name="pto_venta" value="{{ $compra->pto_venta }}" />
    </div>

    <div>
        <label for="codigo_comprobante"> Nro Comprobante </label>
        <input id="codigo_comprobante" type="text" name="codigo_comprobante" value="{{ $compra->codigo_comprobante }}" />
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
        <label for="client_id"> Codigo Cliente </label>
        <input readonly id="client_id" type="text" name="client_id" value="{{ $cliente->id }}" />
    </div>
    <div>
        <label for="name"> Nombre Cliente </label>
        <input readonly id="name" type="text" name="name" value="{{ $cliente->name }}" />
    </div>
    <div>
        <label for="cuit"> CUIT </label>
        <input readonly id="cuit" type="text" name="cuit" value="{{ $cliente->cuit }}" />
    </div>
    <div>
        <label for="condition"> Condicion </label>
        <input readonly id="condition" type="text" name="condition" value="{{ $cliente->condition }}" />
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
        <label for="impuestos_internos"> impuestos_internos </label>
        <input id="impuestos_internos" type="text" name="impuestos_internos" value="{{ $compra->impuestos_internos }}" />
    </div>
    <div>
        <label for="conceptos_no_gravados"> conceptos_no_gravados </label>
        <input id="conceptos_no_gravados" type="text" name="conceptos_no_gravados" value="{{ $compra->conceptos_no_gravados }}" />
    </div>
    <div>
        <label for="compras_no_inscriptas"> compras_no_inscriptas </label>
        <input id="compras_no_inscriptas" type="text" name="compras_no_inscriptas" value="{{ $compra->compras_no_inscriptas }}" />
    </div>
    <div>
        <label for="tipo_calculo"> Tipo de Calculo </label>
        <input id="tipo_calculo" type="text" step="any" name="tipo_calculo" value="{{ $compra->tipo_calculo }}" />
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
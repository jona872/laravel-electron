@extends('layout')

@section('content')

<h1 class="title--header">
    <a href="/ventas" role="button" class="row--centered">
        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        <span>Ventas</span>
    </a>
</h1>



<form action="{{ route('ventas.store') }}" method="POST" class="card--form">
    @csrf
    <div>
        <label for="fecha"> Fecha </label>
        <input id="fecha" type="text" name="fecha" value="{{ old('fecha') }}" />
    </div>

    <div>
        <label for="pto_venta"> Pto de Venta </label>
        <input id="pto_venta" type="text" name="pto_venta" value="{{ old('pto_venta') }}" />
    </div>

    <div>
        <label for="codigo"> Nro Comprobante </label>
        <input id="codigo" type="text" name="codigo" value="{{ old('codigo') }}" />
    </div>

    <div>
        <label for="tipo_comprobante"> Tipo de Comprobante </label>
        <select name="tipo_comprobante" id="tipo_comprobante">
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
        <input id="codigo" type="text" name="codigo" value="{{ old('codigo') }}" />
    </div>
    <div>
        <label for="nombre"> Nombre Cliente </label>
        <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" />
    </div>
    <div>
        <label for="cuit"> CUIT </label>
        <input id="cuit" type="text" name="cuit" value="{{ old('cuit') }}" />
    </div>
    <div>
        <label for="condicion"> Condicion </label>
        <input id="condicion" type="text" name="condicion" value="{{ old('condicion') }}" />
    </div>
    <br>
    <hr>
    <br>
    <div>
        <label for="neto"> Neto </label>
        <input id="neto" type="text" name="neto" value="{{ old('neto') }}" />
    </div>
    <div>
        <label for="iva"> I.V.A. </label>
        <input id="iva" type="text" name="iva" value="{{ old('iva') }}" />
    </div>
    <div>
        <label for="iva_liquidado"> I.V.A. Liquidado </label>
        <input id="iva_liquidado" type="text" name="iva_liquidado" value="{{ old('iva_liquidado') }}" />
    </div>
    <div>
        <label for="iva_sobretasa"> Sobre Ta. I.V.A. </label>
        <input id="iva_sobretasa" type="text" name="iva_sobretasa" value="{{ old('iva_sobretasa') }}" />
    </div>
    <div>
        <label for="percepcion"> Percepcion </label>
        <input id="percepcion" type="text" name="percepcion" value="{{ old('percepcion') }}" />
    </div>
    <div>
        <label for="iva_retencion"> I.V.A. Retencion </label>
        <input id="iva_retencion" type="text" name="iva_retencion" value="{{ old('iva_retencion') }}" />
    </div>
    <div>
        <label for="conceptos_no_gravados"> Conceptos No Gravados </label>
        <input id="conceptos_no_gravados" type="text" name="conceptos_no_gravados" value="{{ old('conceptos_no_gravados') }}" />
    </div>
    <div>
        <label for="ingresos_exentos"> Ingresos Externos </label>
        <input id="ingresos_exentos" type="text" name="ingresos_exentos" value="{{ old('ingresos_exentos') }}" />
    </div>
    <div>
        <label for="ganancias_retencion"> Retencion de Ganancias </label>
        <input id="ganancias_retencion" type="text" name="ganancias_retencion" value="{{ old('ganancias_retencion') }}" />
    </div>
    <br>
    <hr>
    <br>
    <div>
        <label for="total"> Total </label>
        <input id="total" type="number" name="total" value="{{ old('total') }}" />
    </div>
    <div>
        <label for="tipo_op"> Tipo de Operacion </label>
        <input id="tipo_op" type="number" step="any" name="tipo_op" value="{{ old('tipo_op') }}" />
    </div>

    <div class="card--row">
        <button class="card--btn">
            <a href="{{ route('ventas.index') }}">{{ __('Cancelar') }}</a>
        </button>

        <button type="submit" class="card--btn"> Guardar </button>
    </div>

</form>


@endsection
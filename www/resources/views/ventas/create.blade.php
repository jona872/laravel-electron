@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/smoothness/jquery-ui.min.css') }}">
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

@if ($errors->any())
	<div class="invalid-feedback">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif



<form action="{{ route('ventas.store') }}" method="POST" class="card--form">
    @csrf
    <div>
        <label for="fecha"> Fecha </label>
        <input id="fecha" type="text" name="fecha" value="{{ old('fecha') }}" placeholder="aaaa-mm-dd"/>
    </div>

    <div>
        <label for="pto_venta"> Pto de Venta </label>
        <input id="pto_venta" type="text" name="pto_venta" value="{{ old('pto_venta') }}" />
    </div>

    <div>
        <label for="codigo_comprobante"> Nro Comprobante </label>
        <input id="codigo_comprobante" type="text" name="codigo_comprobante" value="{{ old('codigo_comprobante') }}" />
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
        <label for="client_id"> Codigo Cliente </label>
        <input id="client_id" type="text" name="client_id" value="{{ old('client_id') }}" />
    </div>
    <div>
        <label for="name"> Nombre Cliente </label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" />
    </div>
    <div>
        <label for="cuit"> CUIT </label>
        <input id="cuit" type="text" name="cuit" value="{{ old('cuit') }}" />
    </div>
    <div>
        <label for="condition"> Condicion </label>
        <input id="condition" type="text" name="condition" value="{{ old('condition') }}" />
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
        <label for="ingresos_exentos"> Ingresos Exentos </label>
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
        <input id="total" type="text" step="any" name="total" value="{{ old('total') }}" />
    </div>
    <div>
        <label for="tipo_op"> Tipo de Operacion </label>
        <input id="tipo_op" type="text" step="any" name="tipo_op" value="{{ old('tipo_op') }}" />
    </div>
    <div>
        <label for="tipo_calculo"> Tipo de Calculo </label>
        <input id="tipo_calculo" type="text" step="any" name="tipo_calculo" value="{{ old('tipo_calculo') }}" />
    </div>

    <div class="card--row">
        <a class="btn btn--cancel a--btn" href="{{ route('ventas.index') }}">{{ __('Cancelar') }}</a>

        <button type="submit" class="btn btn--confirm"> Guardar </button>
    </div>

</form>

<!-- MANDATORY -->
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<script type="text/javascript">
    console.log("cargo ventas");
    let dataGlobal;
    let globalClientClienteCode = [];
    let globalClientClienteName = [];
    let globalClientClienteCuit = [];

    // fetch all data and filters
    const getData = async () => {
        const response = await fetch("/api/v1/clientes/listado");
        const data = await response.json();
        dataGlobal = data;
        data.map(element => {
            globalClientClienteCode.push(element.id.toString())
            globalClientClienteName.push(element.name)
            globalClientClienteCuit.push(element.cuit)
        });
        return dataGlobal;
    };
    (async () => {
        await getData();
    })();
    //=============================================================

    //Each field autocomplete
    $("#client_id").autocomplete({
        source: globalClientClienteCode,
        select: function(event, ui) { //ui.item -> label and value
            dataGlobal.map(element => { //element = cada obj cliente
                if (element.id === parseInt(ui.item.value)) {
                    document.getElementById("client_id").value = parseInt(element.id)
                    document.getElementById("name").value = element.name
                    document.getElementById("cuit").value = element.cuit
                    document.getElementById("condition").value = element.condition
                }
            });
        }
    });
    //=======================
    $("#name").autocomplete({
        source: globalClientClienteName,
        select: function(event, ui) { //ui.item -> label and value
            dataGlobal.map(element => { //element = cada obj cliente            
                if (element.name === ui.item.value) {
                    document.getElementById("client_id").value = element.id
                    document.getElementById("name").value = element.name
                    document.getElementById("cuit").value = element.cuit
                    document.getElementById("condition").value = element.condition
                }
            });
        }
    });
    //=======================
    $("#cuit").autocomplete({
        source: globalClientClienteCuit,
        select: function(event, ui) { //ui.item -> label and value
            dataGlobal.map(element => { //element = cada obj cliente
                if (element.cuit === ui.item.value) {
                    document.getElementById("client_id").value = element.id
                    document.getElementById("name").value = element.name
                    document.getElementById("cuit").value = element.cuit
                    document.getElementById("condition").value = element.condition
                }
            });
        }
    });
    //=======================
</script>

@endsection
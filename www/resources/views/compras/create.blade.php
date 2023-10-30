@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/buckup/smoothness/jquery-ui.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/buckup/compras.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/buckup/form.css') }}">
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

@if ($errors->any())
<div class="invalid-feedback">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


<form action="{{ route('compras.store') }}" method="POST">
  @csrf
  <div class="container">

    <div class="left--panel">

      <div class="form--row">
        <label for="fecha" class="form--row--label"> Fecha </label>
        <input id="fecha" class="form--row--input" type="text" name="fecha" value="{{ old('fecha') }}" placeholder="aaaa-mm-dd" />
      </div>
      <div class="form--row">
        <label for="pto_venta"> Pto de Venta </label>
        <input id="pto_venta" type="text" name="pto_venta" value="{{ old('pto_venta') }}" />
      </div>
      <div class="form--row">
        <label for="codigo_comprobante"> Nº Comprobante </label>
        <input id="codigo_comprobante" type="text" name="codigo_comprobante" value="{{ old('codigo_comprobante') }}" />
      </div>
      <div class="form--row">
        <label for="tipo_comprobante"> Tipo de Comprobante </label>
        <select name="tipo_comprobante" id="tipo_comprobante">
          <option value="Otros">Otros</option>
          <option value="Factura A">Factura A</option>
          <option value="Factura B">Factura B</option>
          <option value="Factura C">Factura C</option>
        </select>
      </div>
      <div class="form--row">
        <label for="client_id"> Codigo Cliente </label>
        <input id="client_id" type="text" name="client_id" value="{{ old('client_id') }}" />
      </div>
      <div class="form--row">
        <label for="name"> Nombre Cliente </label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" />
      </div>
      <div class="form--row">
        <label for="cuit"> CUIT </label>
        <input id="cuit" type="text" name="cuit" value="{{ old('cuit') }}" />
      </div>
      <div class="form--row">
        <label for="condition"> Condicion </label>
        <input id="condition" type="text" name="condition" value="{{ old('condition') }}" />
      </div>
    </div>

    <div class="right--panel">
      <div class="form--row">
        <label for="neto"> Neto </label>
        <input id="neto" type="number" name="neto" step='0.01' value="0.00" />
      </div>
      <div class="form--row">
        <label for="iva"> I.V.A. </label>
        <input id="iva" type="number" name="iva" value="21" />
      </div>
      <div class="form--row">
        <label for="iva_liquidado"> I.V.A. Liquidado </label>
        <input id="iva_liquidado" type="number" name="iva_liquidado" step='0.01' value="0.00" />
      </div>
      <div class="form--row">
        <label for="iva_sobretasa"> Sobre Ta. I.V.A. </label>
        <input id="iva_sobretasa" type="number" name="iva_sobretasa" step='0.01' value="0.00" />
      </div>
      <div class="form--row">
        <label for="percepcion"> Percepcion </label>
        <input id="percepcion" type="number" name="percepcion" step='0.01' value="0.00" />
      </div>
      <div class="form--row">
        <label for="iva_retencion"> I.V.A. Retencion </label>
        <input id="iva_retencion" type="number" name="iva_retencion" value="0.00" />
      </div>
      <div class="form--row">
        <label for="impuestos_internos"> Impuestos Internos </label>
        <input id="impuestos_internos" type="number" name="impuestos_internos" value="0.00" />
      </div>
      <div class="form--row">
        <label for="conceptos_no_gravados"> Conceptos No Gravados </label>
        <input id="conceptos_no_gravados" type="number" name="conceptos_no_gravados" value="0.00" />
      </div>
      <div class="form--row">
        <label for="compras_no_inscriptas"> Compras no Inscriptas </label>
        <input id="compras_no_inscriptas" type="number" name="compras_no_inscriptas" value="0.00" />
      </div>
      <div class="form--row">
        <label for="total"> Total </label>
        <input id="total" type="text" step="any" name="total" value="{{ old('total') }}" />
      </div>
      <div class="form--row">
        <label for="tipo_op"> Tipo de Operacion </label>
        <input id="tipo_op" type="text" step="any" name="tipo_op" value="{{ old('tipo_op') }}" />
      </div>
      <div class="form--row">
        <label for="tipo_calculo"> Tipo de Calculo </label>
        <input id="tipo_calculo" type="text" step="any" name="tipo_calculo" value="{{ old('tipo_calculo') }}" />
      </div>
    </div>
  </div>


  <div class="row text-center mt-2">
    <div class="d-flex justify-content-center gap-2 flex-wrap">
      <a class="btn btn-danger" href="{{ route('compras.index') }}">{{ __('Cancelar') }}</a>
      <button type="submit" class="btn btn-primary"> Guardar </button>
    </div>
  </div>

</form>

<!-- MANDATORY -->
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<script type="text/javascript">
  let dataGlobal;
  let globalClientClienteCode = [];
  let globalClientClienteName = [];
  let globalClientClienteCuit = [];


  let a1_neto = document.getElementById('neto');
  let a2_iva = document.getElementById('iva');
  let a3_iva_liquidado = document.getElementById('iva_liquidado');
  let a4_iva_sobretasa = document.getElementById('iva_sobretasa');
  let a5_percepcion = document.getElementById('percepcion');
  let a6_iva_retencion = document.getElementById('iva_retencion');
  let a7_impuestos_internos = document.getElementById('impuestos_internos');
  let a8_conceptos_no_gravados = document.getElementById('conceptos_no_gravados');
  let a9_compras_no_inscriptas = document.getElementById('compras_no_inscriptas');
  let a11_total = document.getElementById('total');
  // let editableButtons = [ a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_conceptos_no_gravados, a9_compras_no_inscriptas ];

  function clearFields(vButtons) {
    vButtons.map((btn) => {
      btn.value = parseFloat('0').toFixed(2);
    });
  }

  $("#tipo_calculo").focusout(function() {

    switch (document.getElementById("tipo_calculo").value) {
      case '1':
        clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a8_conceptos_no_gravados, a9_compras_no_inscriptas]);
        a1_neto.value = parseFloat((a11_total.value - a9_compras_no_inscriptas.value - a8_conceptos_no_gravados.value - a7_impuestos_internos.value - a6_iva_retencion.value - a5_percepcion.value) / (1 + a2_iva.value) * 100).toFixed(2);
        a3_iva_liquidado.value = parseFloat(a1_neto.value * (a2_iva.value / 100)).toFixed(2);
        break;
      case '4':
        clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a9_compras_no_inscriptas]);
        a8_conceptos_no_gravados.value = parseFloat(a11_total.value - a9_compras_no_inscriptas.value - a7_impuestos_internos.value - a6_iva_retencion.value - a5_percepcion.value).toFixed(2);
        break;
      case '5':
        clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_conceptos_no_gravados, a9_compras_no_inscriptas]);
        a3_iva_liquidado.value = parseFloat(a11_total.value).toFixed(2);
        break;
      default:
        console.log(`No op available`);
    }


  });



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
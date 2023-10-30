@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/buckup/smoothness/jquery-ui.min.css') }}">
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

<form action="{{ route('compras.update',$compra->id) }}" method="POST" class="card--form">
    @csrf
    @method('PUT')
    <input name="id" type="hidden" value="{{ $compra->id }}">
    <div class="container">

        <div class="left--panel">
            <div class="form--row">
                <label for="fecha"> Fecha </label>
                <input id="fecha" type="text" name="fecha" value="{{ $compra->fecha }}" />
            </div>

            <div class="form--row">
                <label for="pto_venta"> Pto de Venta </label>
                <input id="pto_venta" type="text" name="pto_venta" value="{{ $compra->pto_venta }}" />
            </div>

            <div class="form--row">
                <label for="codigo_comprobante"> Nro Comprobante </label>
                <input id="codigo_comprobante" type="text" name="codigo_comprobante" value="{{ $compra->codigo_comprobante }}" />
            </div>

            <div class="form--row">
                <label for="tipo_comprobante"> Tipo de Comprobante </label>
                <select name="tipo_comprobante" id="tipo_comprobante">
                    <option selected="selected"> {{ $compra->tipo_comprobante }} </option>
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
                <input id="neto" type="text" name="neto" value="{{ $compra->neto }}" />
            </div>
            <div class="form--row">
                <label for="iva"> I.V.A. </label>
                <input id="iva" type="text" name="iva" value="{{ $compra->iva }}" />
            </div>
            <div class="form--row">
                <label for="iva_liquidado"> I.V.A. Liquidado </label>
                <input id="iva_liquidado" type="text" name="iva_liquidado" value="{{ $compra->iva_liquidado }}" />
            </div>
            <div class="form--row">
                <label for="iva_sobretasa"> Sobre Ta. I.V.A. </label>
                <input id="iva_sobretasa" type="text" name="iva_sobretasa" value="{{ $compra->iva_sobretasa }}" />
            </div>
            <div class="form--row">
                <label for="percepcion"> Percepcion </label>
                <input id="percepcion" type="text" name="percepcion" value="{{ $compra->percepcion }}" />
            </div>
            <div class="form--row">
                <label for="iva_retencion"> I.V.A. Retencion </label>
                <input id="iva_retencion" type="text" name="iva_retencion" value="{{ $compra->iva_retencion }}" />
            </div>
            <div class="form--row">
                <label for="impuestos_internos"> Impuestos Internos </label>
                <input id="impuestos_internos" type="text" name="impuestos_internos" value="{{ $compra->impuestos_internos }}" />
            </div>
            <div class="form--row">
                <label for="conceptos_no_gravados"> Conceptos No Gravados </label>
                <input id="conceptos_no_gravados" type="text" name="conceptos_no_gravados" value="{{ $compra->conceptos_no_gravados }}" />
            </div>
            <div class="form--row">
                <label for="compras_no_inscriptas"> Compras No Inscriptas </label>
                <input id="compras_no_inscriptas" type="text" name="compras_no_inscriptas" value="{{ $compra->compras_no_inscriptas }}" />
            </div>
            <div class="form--row">
                <label for="tipo_calculo"> Tipo de Calculo </label>
                <input id="tipo_calculo" type="text" step="any" name="tipo_calculo" value="{{ $compra->tipo_calculo }}" />
            </div>

            <div class="form--row">
                <label for="total"> Total </label>
                <input id="total" type="text" step="any" name="total" value="{{ $compra->total }}" />
            </div>
            <div class="form--row">
                <label for="tipo_op"> Tipo de Operacion </label>
                <input id="tipo_op" type="text" step="any" name="tipo_op" value="{{ $compra->tipo_op }}" />
            </div>
        </div>
    </div>

    <div class="row text-center mt-3">
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a class="btn btn-danger" href="{{ route('compras.index') }}">{{ __('Cancelar') }}</a>

            <button type="submit" class="btn btn-primary"> Guardar </button>
        </div>
    </div>

</form>
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

    function calcular() {
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
    }

    $("#tipo_calculo, #total").focusout(function() {
        calcular();
    });

    //   $("#tipo_calculo").focusout(function() {

    //     switch (document.getElementById("tipo_calculo").value) {
    //       case '1':
    //         clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a8_conceptos_no_gravados, a9_compras_no_inscriptas]);
    //         a1_neto.value = parseFloat((a11_total.value - a9_compras_no_inscriptas.value - a8_conceptos_no_gravados.value - a7_impuestos_internos.value - a6_iva_retencion.value - a5_percepcion.value) / (1 + a2_iva.value) * 100).toFixed(2);
    //         a3_iva_liquidado.value = parseFloat(a1_neto.value * (a2_iva.value / 100)).toFixed(2);
    //         break;
    //       case '4':
    //         clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a9_compras_no_inscriptas]);
    //         a8_conceptos_no_gravados.value = parseFloat(a11_total.value - a9_compras_no_inscriptas.value - a7_impuestos_internos.value - a6_iva_retencion.value - a5_percepcion.value).toFixed(2);
    //         break;
    //       case '5':
    //         clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_conceptos_no_gravados, a9_compras_no_inscriptas]);
    //         a3_iva_liquidado.value = parseFloat(a11_total.value).toFixed(2);
    //         break;
    //       default:
    //         console.log(`No op available`);
    //     }


    //   });



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
        console.log('dataGlobal :>> ', dataGlobal);
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
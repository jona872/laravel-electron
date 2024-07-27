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
let btn_limpiar = document.getElementById('limpiar');
// let editableButtons = [ a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_conceptos_no_gravados, a9_compras_no_inscriptas ];

function clearFields(vButtons) {
  vButtons.map((btn) => {
    btn.value = parseFloat('0').toFixed(2);
  });
}
function limpiarNumeros() {
  clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_conceptos_no_gravados, a9_compras_no_inscriptas, a11_total]);
}
btn_limpiar.addEventListener('click', limpiarNumeros);

function calcular() {
  let tipoCalculo = document.getElementById("tipo_calculo").value;
  let total = parseFloat(a11_total.value) || 0;
  let iva = parseFloat(a2_iva.value) || 0;
  let percepcion = parseFloat(a5_percepcion.value) || 0;
  let ivaRetencion = parseFloat(a6_iva_retencion.value) || 0;
  let impuestosInternos = parseFloat(a7_impuestos_internos.value) || 0;
  let conceptosNoGravados = parseFloat(a8_conceptos_no_gravados.value) || 0;
  let comprasNoInscriptas = parseFloat(a9_compras_no_inscriptas.value) || 0;

  switch (tipoCalculo) {
    case '1':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa]);

      let netoAjustado = parseFloat(
        (total - comprasNoInscriptas - conceptosNoGravados - impuestosInternos - ivaRetencion - percepcion)
        /
        (1 + (iva / 100))
      ).toFixed(2);

      let iva_liquidado = parseFloat(netoAjustado * (iva / 100)).toFixed(2);
      a3_iva_liquidado.value = iva_liquidado;

      let neto = parseFloat(netoAjustado + percepcion + impuestosInternos + conceptosNoGravados + comprasNoInscriptas).toFixed(2);
      a1_neto.value = neto;

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

//update and triger cals on exit of this fields
$("#percepcion, #iva_retencion, #impuestos_internos, #conceptos_no_gravados, #compras_no_inscriptas, #tipo_calculo, #total").focusout(function () {
  calcular();
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
  select: function (event, ui) { //ui.item -> label and value
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
  select: function (event, ui) { //ui.item -> label and value
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
  select: function (event, ui) { //ui.item -> label and value
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
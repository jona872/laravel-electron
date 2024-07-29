console.log("cargo ventas");
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
let a7_conceptos_no_gravados = document.getElementById('conceptos_no_gravados');
let a8_ingresos_exentos = document.getElementById('ingresos_exentos');
let a9_ganancias_retencion = document.getElementById('ganancias_retencion');
let a11_total = document.getElementById('total');
let btn_limpiar = document.getElementById('limpiar');


// let editableButtons = [ a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_ingresos_exentos, a9_ganancias_retencion ];

function clearFields(vButtons) {
  vButtons.map((btn) => {
    btn.value = parseFloat('0').toFixed(2);
  });
}

function limpiarNumeros() {
  clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_conceptos_no_gravados, a8_ingresos_exentos, a9_ganancias_retencion]);
}
btn_limpiar.addEventListener('click', limpiarNumeros);

function calcular() {
  let total = parseFloat(a11_total.value) || 0;
  let iva = parseFloat(a2_iva.value) || 0;
  let percepcion = parseFloat(a5_percepcion.value) || 0;
  let ivaRetencion = parseFloat(a6_iva_retencion.value) || 0;
  let conceptosNoGravados = parseFloat(a7_conceptos_no_gravados.value) || 0;
  let ingresosExentos = parseFloat(a8_ingresos_exentos.value) || 0;
  let gananciasRetencion = parseFloat(a9_ganancias_retencion.value) || 0;

  switch (document.getElementById("tipo_op").value) {
    case '1':
      clearFields([a1_neto, a3_iva_liquidado]);
      // a1_neto.value = parseFloat((total - a9_ganancias_retencion.value - a8_ingresos_exentos.value - a7_conceptos_no_gravados.value - ivaRetencion - percepcion) / (1 + iva) * 100).toFixed(2);
      // a3_iva_liquidado.value = parseFloat(a1_neto.value * (iva / 100)).toFixed(2);
      a1_neto.value = parseFloat((total - conceptosNoGravados - ingresosExentos - gananciasRetencion - percepcion - ivaRetencion) / (1 + iva / 100)).toFixed(2);
      a3_iva_liquidado.value = parseFloat(a1_neto.value * (iva / 100)).toFixed(2);
      break;
      break;
    case '4':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_conceptos_no_gravados, a9_ganancias_retencion]);
      a8_ingresos_exentos.value = parseFloat(total - a9_ganancias_retencion.value - a7_conceptos_no_gravados.value - ivaRetencion - percepcion).toFixed(2);
      break;
    case '5':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_conceptos_no_gravados, a8_ingresos_exentos, a9_ganancias_retencion]);
      a3_iva_liquidado.value = parseFloat(total).toFixed(2);
      break;
    default:
      console.log(`No op available`);
  }
}
$("#tipo_op, #total").focusout(function () {
  calcular();
});
$("#conceptos_no_gravados, #ingresos_exentos, #retencion_ganancias, #percepcion, #iva_retencion, #tipo_calculo, #total").focusout(function () {
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
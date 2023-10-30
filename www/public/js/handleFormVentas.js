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


// let editableButtons = [ a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_impuestos_internos, a8_ingresos_exentos, a9_ganancias_retencion ];

function clearFields(vButtons) {
  vButtons.map((btn) => {
    btn.value = parseFloat('0').toFixed(2);
  });
}

function calcular() {
  switch (document.getElementById("tipo_calculo").value) {
    case '1':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a8_ingresos_exentos, a9_ganancias_retencion]);
      a1_neto.value = parseFloat((a11_total.value - a9_ganancias_retencion.value - a8_ingresos_exentos.value - a7_conceptos_no_gravados.value - a6_iva_retencion.value - a5_percepcion.value) / (1 + a2_iva.value) * 100).toFixed(2);
      a3_iva_liquidado.value = parseFloat(a1_neto.value * (a2_iva.value / 100)).toFixed(2);
      break;
    case '4':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_conceptos_no_gravados, a9_ganancias_retencion]);
      a8_ingresos_exentos.value = parseFloat(a11_total.value - a9_ganancias_retencion.value - a7_conceptos_no_gravados.value - a6_iva_retencion.value - a5_percepcion.value).toFixed(2);
      break;
    case '5':
      clearFields([a1_neto, a3_iva_liquidado, a4_iva_sobretasa, a5_percepcion, a6_iva_retencion, a7_conceptos_no_gravados, a8_ingresos_exentos, a9_ganancias_retencion]);
      a3_iva_liquidado.value = parseFloat(a11_total.value).toFixed(2);
      break;
    default:
      console.log(`No op available`);
  }
}
$("#tipo_calculo, #total").focusout(function () {
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
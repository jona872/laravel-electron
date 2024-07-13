<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Resumen-{$operatoria}-Periodos-{$mes}-{$mes_final}.xls";
header("Content-type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

// Agrega BOM para UTF-8
echo "\xEF\xBB\xBF";
?>

<style>
   td {
      border: 1px solid black;
   }

   b {
      font-size: 16px;
   }
</style>

<h1>Libro de I.V.A. {{$operatoria}} de: {{$user->name}} - Períodos: {{$mes}} al {{$mes_final}}</h1>
<b>Domicilio: RUTA 18 - KM. 10</b>
<br>
<b>C.U.I.T.: {{$user->cuit}}</b>
<br>
<br>

<table>
<tr>
          <th>
            <div>Fecha</div>
          </th>
          <th>
            <div>Punto de Venta</div>
          </th>
          <th>
            <div>Nrp de Compro</div>
          </th>
          <th>
            <div>Tipo de Compro</div>
          </th>
          <th>
            <div>Nombre</div>
          </th>
          <th>
            <div>CUIT</div>
          </th>
          <th>
            <div>Resp. IVA</div>
          </th>
          <th>
            <div>Neto Gravado</div>
          </th>
          <th>
            <div>Tasa de I.V.A.</div>
          </th>
          <th>
            <div>I.V.A. Liquiddo</div>
          </th>
          <th>
            <div>Sobre I.V.A.</div>
          </th>
          <th>
            <div>Percep D.G.R.</div>
          </th>
          <th>
            <div>Reten. I.V.A.</div>
          </th>
          <th>
            <div>Concep No Gravados</div>
          </th>
          <th>
            <div>Ingresos Externos</div>
          </th>
          <th>
            <div>Reten Gcias</div>
          </th>
          <th>
            <div>Total</div>
          </th>
          <th>
            <div>Tipo Op</div>
          </th>
        </tr>
   @if (count($consulta ?? '') > 0)
   <input type="hidden" name="exportData" value="{{base64_encode(serialize($consulta))}}">
   @foreach ($consulta ?? '' as $c)
   <tr>
      <td> {{$c->fecha }} </td>
      <td> {{$c->pto_venta }} </td>
      <td> {{$c->codigo_comprobante }} </td>
      <td> {{$c->tipo_comprobante }} </td>
      <td> {{$c->name }} </td>
      <td> {{$c->cuit }} </td>
      <td> {{$c->condition }} </td>
      <td> {{$c->neto }} </td>
      <td> {{$c->iva }} </td>
      <td> {{$c->iva_liquidado }} </td>
      <td> {{$c->iva_sobretasa }} </td>
      <td> {{$c->percepcion }} </td>
      <td> {{$c->iva_retencion }} </td>
      <td> {{$c->conceptos_no_gravados }} </td>
      <td> {{$c->ingresos_exentos }} </td>
      <td> {{$c->ganancias_retencion }} </td>
      <td> {{$c->total }} </td>
      <td> {{$c->tipo_op }} </td>
   </tr>
   @endforeach
   @else
   <input type="hidden" name="exportData" value="">
   <tr>
      <td align="center" colspan="18"> No se encontraron compras </td>
   </tr>
   @endif

</table>
<?php
header("Pragma: public");
header("Expires: 0");
$filename = "nombreArchivoQueDescarga.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>

<style>
   td {
      border: 1px solid black;
   }

   b {
      font-size: 16px;
   }
</style>

<h1>Libro de I.V.A. Compras de: {{$user->name}} - Per�odo: {{$mes}}/{{$year}} - ()</h1>
<b>Domicilio: RUTA 18 - KM. 10</b>
<br>
<b>C.U.I.T.: {{$user->cuit}}</b>
<br>
<br>

<table>
   <tr>
      <th style="background-color: #bfbfbf;">
         Fecha
      </th>
      <th style="background-color: #bfbfbf;">
         Punto de Venta
      </th>
      <th style="background-color: #bfbfbf;">
         N� de Compro
      </th>
      <th style="background-color: #bfbfbf;">
         Tipo de Compro
      </th>
      <th style="background-color: #bfbfbf;">
         Nombre
      </th>
      <th style="background-color: #bfbfbf;">
         CUIT
      </th>
      <th style="background-color: #bfbfbf;">
         Resp. IVA
      </th>
      <th style="background-color: #bfbfbf;">
         Neto Gravado
      </th>
      <th style="background-color: #bfbfbf;">
         Tasa de I.V.A
      </th>
      <th style="background-color: #bfbfbf;">
         I.V.A. Liquiddo
      </th>
      <th style="background-color: #bfbfbf;">
         Sobre I.V.A
      </th>
      <th style="background-color: #bfbfbf;">
         Percep D.G.R
      </th>
      <th style="background-color: #bfbfbf;">
         Reten. I.V.A
      </th>
      <th style="background-color: #bfbfbf;">
         Concep No Gravados
      </th>
      <th style="background-color: #bfbfbf;">
         Ingresos Externos
      </th>
      <th style="background-color: #bfbfbf;">
         Reten Gcias
      </th>
      <th style="background-color: #bfbfbf;">
         Total
      </th>
      <th style="background-color: #bfbfbf;">
         Tipo Op
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
      <td> {{$c->impuestos_internos }} </td>
      <td> {{$c->conceptos_no_gravados }} </td>
      <td> {{$c->compras_no_inscriptas }} </td>
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
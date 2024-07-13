<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Resumen-Anual-{$operatoria}-{$year}.xls";
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

<h1>Libro de I.V.A. Compras de: {{$user->name}} - Período: {{$year}} </h1>
<b>Domicilio: RUTA 18 - KM. 10</b>
<br>
<b>C.U.I.T.: {{$user->cuit}}</b>
<br>
<br>

<table>
   <tr>
      <th>
         Fecha
      </th>
      <th>
         Pto de Venta
      </th>
      <th>
         Nº de Compro
      </th>
      <th>
         Tipo de Compro
      </th>
      <th>
         Nombre
      </th>
      <th>
         CUIT
      </th>
      <th>
         Resp. IVA
      </th>
      <th>
         Neto Gravado
      </th>
      <th>
         Tasa de I.V.A
      </th>
      <th>
         I.V.A. Liquiddo
      </th>
      <th>
         Sobre I.V.A
      </th>
      <th>
         Percep D.G.R
      </th>
      <th>
         Reten. I.V.A
      </th>
      <th>
         Concep No Gravados
      </th>
      <th>
         Ingresos Externos
      </th>
      <th>
         Reten Gcias
      </th>
      <th>
         Total
      </th>
      <th>
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
@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
@endpush

@section('content')


<h1>Listado Mensual de {{ $operatoria }} {{ $year }}-{{ $mes }}</h1>

<div class="container.fluid">
  <!-- <form action="{{url('/mensuales/export')}}" method="POST"> -->
  <form action="{{ url('mensuales/exportv2/'.$operatoria . '/'.$year. '/'.$mes) }}" method="GET">
    @csrf
    <input type="hidden" name="operatoria" value="{{ $operatoria }}">
    <input type="hidden" name="mes" value="{{ $mes }}">
    <input type="hidden" name="year" value="{{ $year }}">

    <table id="resizeMe" class="table table-striped">
      <thead>
        <tr>
          <th class="col-fit">
            <div>Fecha</div>
          </th>
          <th class="col-fit">
            <div>Punto de Venta</div>
          </th>
          <th class="col-fit">
            <div>Nrp de Compro</div>
          </th>
          <th class="col-fit">
            <div>Tipo de Compro</div>
          </th>
          <th class="col-fit">
            <div>Nombre</div>
          </th>
          <th class="col-fit">
            <div>CUIT</div>
          </th>
          <th class="col-fit">
            <div>Resp. IVA</div>
          </th>
          <th class="col-fit">
            <div>Neto Gravado</div>
          </th>
          <th class="col-fit">
            <div>Tasa de I.V.A.</div>
          </th>
          <th class="col-fit">
            <div>I.V.A. Liquiddo</div>
          </th>
          <th class="col-fit">
            <div>Sobre I.V.A.</div>
          </th>
          <th class="col-fit">
            <div>Percep D.G.R.</div>
          </th>
          <th class="col-fit">
            <div>Reten. I.V.A.</div>
          </th>
          <th class="col-fit">
            <div>Concep No Gravados</div>
          </th>
          <th class="col-fit">
            <div>Ingresos Externos</div>
          </th>
          <th class="col-fit">
            <div>Reten Gcias</div>
          </th>
          <th class="col-fit">
            <div>Total</div>
          </th>
          <th class="col-fit">
            <div>Tipo Op</div>
          </th>
        </tr>
      </thead>
      @if (count($consulta ?? '') > 0)
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
      <tr>
        <td align="center" colspan="18"> No se encontraron compras </td>
      </tr>
      @endif
    </table>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary"> Descargar </button>
    </div>

  </form>
</div>




@endsection

@push('scripts')
<script src="{{ asset('js/resizeTables.js') }}"></script>
@endpush
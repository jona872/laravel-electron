@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
@endpush

@section('content')

<h1>
  <a href="{{ url()->previous() }}" class="btn btn-light">
    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
    </svg>
  </a>
  Listado de {{ $operatoria }} Periodos: {{ $mes }} al {{ $mes_final }}
</h1>

<div class="container.fluid">
  <form action="{{url('/periodos/export')}}" method="POST">
    @csrf
    <input type="hidden" name="operatoria" value="{{ $operatoria }}">
    <input type="hidden" name="year" value="{{ $year }}">
    <input type="hidden" name="mes" value="{{ $mes }}">
    <input type="hidden" name="mes_final" value="{{ $mes_final }}">

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
            <div>Nº de Compro</div>
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

    <div class="text-center mt-3">
      <button type="submit" class="btn btn-primary"> Continuar </button>
    </div>
  </form>
</div>





@endsection

@push('scripts')
<script src="{{ asset('js/resizeTables.js') }}"></script>
@endpush
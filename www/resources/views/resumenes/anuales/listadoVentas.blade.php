@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
@endpush

@section('content')
<style>
  * {
    font-size: 12px;
  }
</style>

<h1>
  <a href="{{ url()->previous() }}" class="btn btn-light">
    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
    </svg>
  </a>
  Listado Anual de {{ $operatoria }} {{ $year }}
</h1>


<div class="container.fluid">
  <form action="{{url('/anuales/export')}}" method="POST" class="card--form">
    @csrf
    <input type="hidden" name="operatoria" value="{{ $operatoria }}">
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
          <th>
            Extra
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
        <td> {{$c->conceptos_no_gravados }} </td>
        <td> {{$c->ingresos_exentos }} </td>
        <td> {{$c->ganancias_retencion }} </td>
        <td> {{$c->total }} </td>
        <td> {{$c->tipo_op }} </td>
        <td> {{$c->row_sum }} </td>
      </tr>
      @endforeach
      <tr>
        <td> SUMATORIA </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> {{$columnSums->neto_sum }} </td>
        <td> {{$columnSums->iva_sum }} </td>
        <td> {{$columnSums->iva_liquidado_sum }} </td>
        <td> {{$columnSums->iva_sobretasa_sum }} </td>
        <td> {{$columnSums->percepcion_sum }} </td>
        <td> {{$columnSums->iva_retencion_sum }} </td>
        <td> {{$columnSums->conceptos_no_gravados_sum }} </td>
        <td> {{$columnSums->ingresos_exentos_sum }} </td>
        <td> {{$columnSums->ganancias_retencion_sum }} </td>
        <td> {{$columnSums->total_sum }} </td>
        <td> </td>
        @if($match)
        <td class="text-success">
          <strong>SUMA CORRECTA</strong>
        </td>
        @else
        <td class="text-danger">
          <strong>SUMA INCORRECTA</strong>
        </td>
        @endif
      </tr>
      @else
      <input type="hidden" name="exportData" value="">
      <tr>
        <td align="center" colspan="18"> No se encontraron compras </td>
      </tr>
      @endif
    </table>

    <div class="row text-center mt-3">
      <div class="d-flex justify-content-center g-2 flex-wrap">
        <button type="submit" class="btn btn-primary"> Continuar </button>
      </div>
    </div>
  </form>
</div>





@endsection

@push('scripts')
<script src="{{ asset('js/resizeTables.js') }}"></script>
@endpush
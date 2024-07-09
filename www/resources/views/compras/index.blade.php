@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
@endpush


@section('content')
<h2>Compras</h2>

<div class="container-fluid">

  <a href="compras/create" class="d-flex flex-row align-items-center my-2 gap-3">
    <div class="btn-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
      </svg>
    </div>
    <div>Crear Compra</div>
  </a>

  <table id="resizeMe" class="table table-striped">
    <thead>
      <tr>
        <th class="col-opt-header">
          <div> </div>
        </th>
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
    @if (count($compras ?? '') > 0)
    @foreach ($compras ?? '' as $c)
    <tr>
      <td>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
          <a href="compras/{{$c->id}}/edit" title="Edit" class="btn btn-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
          </a>


          <form action="{{ route('compras.destroy',$c->id) }}" method="POST">

            @csrf
            @method('DELETE')
            <button type="submit" title="Borrar" class="btn btn-danger">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>

          </form>
        </div>
      </td>

      <td class="vertical-middle"> {{$c->fecha }} </td>
      <td class="vertical-middle"> {{$c->pto_venta }} </td>
      <td class="vertical-middle"> {{$c->codigo_comprobante }} </td>
      <td class="vertical-middle"> {{$c->tipo_comprobante }} </td>
      <td class="vertical-middle"> {{$c->name }} </td>
      <td class="vertical-middle"> {{$c->cuit }} </td>
      <td class="vertical-middle"> {{$c->condition }} </td>
      <td class="vertical-middle"> {{$c->neto }} </td>
      <td class="vertical-middle"> {{$c->iva }} </td>
      <td class="vertical-middle"> {{$c->iva_liquidado }} </td>
      <td class="vertical-middle"> {{$c->iva_sobretasa }} </td>
      <td class="vertical-middle"> {{$c->percepcion }} </td>
      <td class="vertical-middle"> {{$c->iva_retencion }} </td>
      <td class="vertical-middle"> {{$c->impuestos_internos }} </td>
      <td class="vertical-middle"> {{$c->conceptos_no_gravados }} </td>
      <td class="vertical-middle"> {{$c->compras_no_inscriptas }} </td>
      <td class="vertical-middle"> {{$c->total }} </td>
      <td class="vertical-middle"> {{$c->tipo_op }} </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td align="center" colspan="18"> No se encontraron compras </td>
    </tr>
    @endif
  </table>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/resizeTables.js') }}"></script>
@endpush
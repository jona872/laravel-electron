@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
@endpush

@section('content')

Listado Anual

<main class="main">
    <div class="container">
        <form action="{{url('/anuales/export')}}" method="POST" class="card--form">
            @csrf
            <input type="hidden" name="operatoria" value="{{ $operatoria }}">
            <input type="hidden" name="year" value="{{ $year }}">

            <table>
                <tr>
                    <th class="col-fit">
                        <div>Fecha</div>
                    </th>
                    <th class="col-fit">
                        <div>Punto de Venta</div>
                    </th>
                    <th class="col-fit">
                        <div>Nro de Compro</div>
                    </th>
                    <th class="col-fit">
                        <div>Nombre</div>
                    </th>
                    <th class="col-fit">
                        <div>Tipo de Compro</div>
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

            <div class="card--row">
                <div class="row--centered">
                    <button type="submit" class="btn btn--confirm"> Continuar </button>
                </div>
            </div>
        </form>




</main>


@endsection
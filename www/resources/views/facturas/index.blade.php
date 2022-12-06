@extends('layout')


@section('content')
<h1>Facturasss</h1>
<a href="/" role="button" class="btn">
  <- Volver </a>
    <br>

    <div>
      <div>
        <ul>
          @if (count($facturas) > 0)
          @foreach ($facturas as $u)
          <hr>  
            <li>{{$u->code }}</li>
            <li>{{$u->type }}</li>
            <li>{{$u->iva }}</li>
            <li>{{$u->total }}</li>
            <hr>
            <br>
          @endforeach
          @else

          <li align="center" colspan="5">No se encontraron Facturas </li>

          @endif
        </ul>
      </div>
    </div>
@endsection
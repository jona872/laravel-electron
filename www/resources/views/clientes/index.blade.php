@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/craftIcons.css')}}">
@endpush

@section('content')
<h1>Clientes</h1>
<a href="/" role="button" class="btn">
    Volver
</a>

<div>
    <a href="clientes/create">
        <ion-icon size="large" name="person-add-sharp"></ion-icon>
    </a>
</div>

<div>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
</div>

<div>
<i class="bi-alarm"></i>
</div>

<main class="main">
    <div class="container">
        <table style="overflow-x:auto;">
            <tr>
                <th class="col-min">Nombre</th>
                <th class="col-fit">CUIT</th>
                <th class="col-fit">Condicion</th>
                <th class="col-fit">Direccion</th>
                <th>Opt</th>
            </tr>
            @if (count($clientes ?? '') > 0)
            @foreach ($clientes ?? '' as $c)
            <tr>
                <td> {{$c->name }} </td>
                <td> {{$c->cuit }} </td>
                <td> {{$c->condition }} </td>
                <td> {{$c->direction }} </td>
                <td style="width: 70px; display: flex; justify-content: center; align-items: center; gap: 0.5rem">
                    <div>
                        <button>
                            <a href="clientes/{{$c->id}}/edit" title="Edit">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                        </button>
                    </div>
                    <form action="{{ route('clientes.destroy',$c->id) }}" method="POST">
                        <div>
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Borrar">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </form>

                </td>
            </tr>
            @endforeach
            @else

            <li align="center" colspan="5">No se encontraron clientes </li>

            @endif
        </table>
    </div>
</main>

@endsection
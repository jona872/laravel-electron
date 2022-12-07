@extends('layout')

@section('content')
Resumenes
<a href="/" role="button" class="btn">
    Volver
</a>

<div>
{{Auth::user()->name}}
    <ul>
        @if (count($clientes ?? '') > 0)
        @foreach ($clientes ?? '' as $u)
        <li>{{$u->name }}</li>
        @endforeach
        @else

        <li align="center" colspan="5">No se encontraron clientes </li>

        @endif
    </ul>
</div>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturita</title>
</head>

<body>
    Factura Main page

    <div>
        <ul>
            @if (count($facturas) > 0)
            @foreach ($facturas as $u)
            <li>{{$u->code }}</li>
            @endforeach
            @else

            <li align="center" colspan="5">No se encontraron Facturas </li>

            @endif
        </ul>
    </div>

</body>

</html>
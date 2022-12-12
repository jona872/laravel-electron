@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" /> -->

@endpush


@section('content')

<form action="">
   <div>
      <label for="name">name</label>
      <input id="name" name="name" type="text" />
   </div>
   <div>
      <label for="cuit">cuit</label>
      <input id="cuit" name="cuit" type="text" />
   </div>
   <div>
      <label for="condition">condition</label>
      <input id="condition" name="condition" type="text" />
   </div>
   <button type="submit">submit</button>
</form>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> <!-- MANDATORY -->
<script src="//code.jquery.com/jquery-1.12.4.js"> </script> <!-- MANDATORY -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"> </script> <!-- MANDATORY -->


<script type="text/javascript">
   let dataGlobal;
   let globalClientClienteCode = [];
   let globalClientClienteName = [];
   let globalClientClienteCuit = [];
   // fetch all data and filters
   const getData = async () => {
      const response = await fetch("/api/v1/clientes/listado");
      const data = await response.json();
      dataGlobal = data;
      data.map(element => {
         globalClientClienteCode.push(element.id)
         globalClientClienteName.push(element.name)
         globalClientClienteCuit.push(element.cuit)
      });
      return dataGlobal;
   };
   (async () => {
      await getData();
   })();
   //=============================================================
   $("#name").autocomplete({
      source: globalClientClienteName,
      select: function(event, ui) { //ui.item -> label and value
         dataGlobal.map(element => { //element = cada obj cliente
            if (element.name === ui.item.value) {
               document.getElementById("name").value = element.name
               document.getElementById("cuit").value = element.cuit
               document.getElementById("condition").value = element.condition
            }
         });
      }
   });

   $("#cuit").autocomplete({
      source: globalClientClienteCuit,
      select: function(event, ui) { //ui.item -> label and value
         dataGlobal.map(element => { //element = cada obj cliente
            if (element.cuit === ui.item.value) {
               document.getElementById("name").value = element.name
               document.getElementById("cuit").value = element.cuit
               document.getElementById("condition").value = element.condition
            }
         });
      }
   });
</script>
@endsection
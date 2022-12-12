@extends('layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/resizeTable.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
<style>
   .container {
      max-width: 600px;
   }
</style>
@endpush


@section('content')

<form action="/autocomplete-search">
   <div>
      <label for="query">Query</label>
      <input id="query" name="query" type="text" />
   </div>
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


<div class="container mt-5">
   <div classs="form-group">
      <input type="text" id="search" name="search" placeholder="Search" class="form-control" />
   </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"> </script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">

</script>



<script type="text/javascript">
   let dataGlobal;
   let globalClientClienteCode = [];
   let globalClientClienteName = [];
   let globalClientClienteCuit = [];

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

   const clientsFetched = []; //lista con todos los clientes y sus att

   $("#search").autocomplete({
      source: globalClientClienteName,
      select: function(event, ui) { //ui.item -> label and value
         dataGlobal.map(element => {
            console.log(element);
            if (element.name === ui.item.value) {
               document.getElementById("name").value = ui.item.value
               document.getElementById("cuit").value = element.cuit
               document.getElementById("condition").value = element.condition
            }
         });
      }
   });
</script>
@endsection
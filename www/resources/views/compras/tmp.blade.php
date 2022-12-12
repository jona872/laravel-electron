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
   var subjects = [
      "HTML",
      "CSS",
      "JavaScript",
      "jQuery",
      "PHP",
      "React",
      "Node.js"
   ];

   $("#search").autocomplete({
      source: subjects,
      select: function(event, ui) {
         alert("Select Event Triggered");
      }
   });


   // var route = "{{ url('autocomplete-search') }}";
   // var client =
   //    $('#search').typeahead({
   //       source: function(query, process) {
   //          return $.get(route, {
   //                query: query
   //             },
   //             function(data) {
   //                return process(data);
   //             });
   //       }
   //    });

   // $('#search').change(function() {
   //    $.ajax({
   //       cache: false,
   //       type: "GET",
   //       async: true,
   //       url: "{{ url('autocomplete-search') }}?query=" + $(this).val(),
   //       contentType: "application/json; charset=ytf-8",
   //       dataType: "json",
   //       processData: true,
   //       success: function(result) {
   //          // console.log("Ajax Result "+JSON.stringify(result));
   //          $.map(result, function(element, index) {
   //             console.log("Element= "+JSON.stringify(element.name), "Index= "+index);
   //             // consol   e.log("Element= "+element,"Index= "+index);
   //          });
   //       },
   //       error: function(xhr, textStatus, errorThrown) {
   //          alert(textStatus + ':' + errorThrown);
   //       }
   //    });
   // });
</script>
@endsection
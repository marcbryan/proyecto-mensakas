@extends('layouts.app')
@section('content')
<div class="col-10 mx-auto mt-3 d-flex">  
 	@if($items->isNotEmpty())	
 		<h3>Productos:</h3><br>
 		<div class="col-5 ">  
			<form action="{{url('')}}" method="get">
		 	 <?php // TODO: Mostrar errores ?>
		 	 @csrf
		 	 	<br><br>
		 		 <div id="listaItems">  
				 @foreach ($items as $item) 
				 <label>{{$item->nameIn('ES')}}<input type="number" name="{{$item->id}}" min="0"></label>
				 	
				 @endforeach
				</div>
			
		</div>
		<div class="col-5 border border-primary" style="min-height: 500px;">  
			<h5 class="mt-2">Carrito<i class="fas fa-shopping-cart"></i>:</h5>
			<div id="carrito"></div>
		</div>
</div>
		<input required type="submit" class="btn btn-primary mt-3 float-right" value="Siguente">
		</form>
		@else
			<div class="alert alert-danger mt-5" role="alert">
			  <h4 class="alert-heading">UPS!</h4>
			  <p>Lamentablemente no hay productos añadidos a este restaurante.</p>
			</div>
		@endif
		

@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $('.nav-link').hide();      
	});

	$('#listaItems').change(function(){
		$("#carrito").empty();
		$("#listaItems label input" ).each(function( index ) {
			if ($(this).val()>=1 && $(this).val()) {
  				$("#carrito").append( "<p>" + $( this ).parent().text()+" : "+$(this).first().val()+" </p>" );
  			}
		});

	})
</script>

@endsection

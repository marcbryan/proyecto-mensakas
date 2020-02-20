@extends('layouts.app')
@section('content')
<div class="col-6 mx-auto mt-3">  
 	@if($PosiblesBusiness->isNotEmpty())	
 		<h3>Selecciona restaurante:</h3>
		<form action="{{url('storeSaveBussiness')}}" method="get">
	 	 <?php // TODO: Mostrar errores ?>
	 	 @csrf
	 		<select name="business">	  	 
			 @foreach ($PosiblesBusiness as $business) 
			 	<option value="{{$business->id}}">{{$business->name}}</option>";
			 @endforeach	
			 </select>
		<input required type="submit" class="btn btn-primary" value="Siguente">
		</form>
		@else
			<div class="alert alert-danger mt-5" role="alert">
			  <h4 class="alert-heading">UPS!</h4>
			  <p>Lamentablemente no hay restaurantes que dispongan de nuestro servicio cerca tuyo.</p>
			</div>
		@endif
		

 </div> 

@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $('.nav-link').hide();      
	});
</script>

@endsection

@extends('layouts.app')
@section('styles')
html, body, .containter{height:100%;}
html{overflow:hidden;}
.blob {
	background: white;
	border-radius: 5%;
	margin: 10px;

	box-shadow: 0 0 0 0 rgba(255, 255, 255, 1);
	transform: scale(1);
	animation: pulse 2s infinite;
}
@keyframes pulse {
	0% {
		transform: scale(0.95);
		box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
	}

	70% {
		transform: scale(1);
		box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
	}

	100% {
		transform: scale(0.95);
		box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
	}
}
@endsection

@section('content')
<div class="d-flex vh-100">
  <div class="d-flex w-100 justify-content-center align-self-center">
   <a href="{{url('newConsumer')}}"  type="button" class="btn blob justify-content-center btn-light"><b>Hacer pedido</b></a>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $("body").css("background-image",'url("../../images/branding/fondo1.jpeg")');

      $("body").css("background-position","center");
      $("body").css("background-repeat","no-repeat");
      $("body").css("background-size",'cover');
	});
	

</script>
 
@endsection

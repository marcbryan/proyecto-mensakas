@extends('layouts.app')

@section('style')
#fondoPrincipal {
* The image used */
  background-image: url("../../images/branding/fondo1.jpeg");

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

@endsection

@section('content')
 
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

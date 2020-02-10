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
<div id="fondoPrincipal"></div>
 
@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
  		$( "body > .container" ).removeClass( "container" );
	});
	

</script>
 
@endsection
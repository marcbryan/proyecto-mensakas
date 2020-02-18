@extends('layouts.app')
@section('styles')
body{background-color:#BDA8D3 ;}
@endsection

@section('content')
<form>
	<label>Nombre</label>
	<label>Apellidos</label>
	<label>email</label>
	<label>Dirección</label>
	<label>Codigo postal</label>
	<label>Telefono/Movil</label>
</form>
@endsection


@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $('.nav-link').hide();      
	});
</script>

@endsection

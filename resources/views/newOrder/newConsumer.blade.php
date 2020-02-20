@extends('layouts.app', ['model'=>'consumers'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
form{padding: 0 15px;}
@endsection
@section('content')
<div class="col-6 mx-auto mt-3">
<form action="{{url('storeSaveConsumer')}}" method="get">
  <?php // TODO: Mostrar errores ?>
  @csrf
  <div class="form-group">
    <label for="">Nombre</label>
    <input required type="text" name="first_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Apellidos</label>
    <input required type="text" name="last_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Correo electrónico</label>
    <input required type="text" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Dirección</label>
    <input required type="text" name="address" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Código postal</label>
    <input required type="text" name="zipcode" class="form-control" minlength="5">
  </div>
  <div class="form-group">
    <label for="}">Teléfono</label>
    <input required type="text" name="phone" class="form-control" minlength="9">
  </div>
  <input required type="submit" class="btn btn-primary" value="Acceder">
</form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $('.nav-link').hide();      
	});
</script>

@endsection

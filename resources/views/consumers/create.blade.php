@extends('layouts.app', ['model'=>'consumers'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
form{padding: 0 15px;}
@endsection
@section('content')
<form action="{{route('consumers.store')}}" method="post" class="mt-2">
  <?php // TODO: Mostrar errores ?>
  @csrf
  <div class="form-group">
    <label for="first_name">Nombre</label>
    <input type="text" name="first_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="last_name">Apellidos</label>
    <input type="text" name="last_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input type="text" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" name="address" class="form-control">
  </div>
  <div class="form-group">
    <label for="zipcode">Código postal</label>
    <input type="text" name="zipcode" class="form-control">
  </div>
  <div class="form-group">
    <label for="phone">Teléfono</label>
    <input type="text" name="phone" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

@extends('layouts.app', ['model'=>'deliverers'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
form{padding: 0 15px;}
@endsection
@section('content')
<form action="{{route('deliverers.store')}}" method="post" class="mt-2">
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
    <label for="password">Contraseña</label>
    <input type="password" name="password" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

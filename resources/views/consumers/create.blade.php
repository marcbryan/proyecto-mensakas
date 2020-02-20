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
    <label for="{{$columns[2]}}">Nombre</label>
    <input type="text" name="{{$columns[2]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[3]}}">Apellidos</label>
    <input type="text" name="{{$columns[3]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[5]}}">Correo electrónico</label>
    <input type="text" name="{{$columns[5]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[8]}}">Dirección</label>
    <input type="text" name="{{$columns[8]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[9]}}">Código postal</label>
    <input type="text" name="{{$columns[9]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[10]}}">Teléfono</label>
    <input type="text" name="{{$columns[10]}}" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

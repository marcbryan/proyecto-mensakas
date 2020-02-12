@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
@endsection
@section('content')
<form action="" method="post" class="mt-2">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="{{$columns[2]}}">Nombre</label>
    <input type="text" name="{{$columns[2]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[3]}}">Apellidos</label>
    <input type="text" name="{{$columns[3]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[4]}}">Correo electrónico</label>
    <input type="text" name="{{$columns[4]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[5]}}">Contraseña</label>
    <input type="password" name="{{$columns[5]}}" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

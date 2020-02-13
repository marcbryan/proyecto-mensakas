@extends('layouts.logged', ['model'=>'business'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
@endsection
@section('content')
<form action="{{route('business.store')}}" method="post" class="mt-2">
  @csrf

  <div class="form-group">
    <label for="{{$columns[1]}}">Nombre del negocio</label>
    <input type="text" name="{{$columns[1]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[2]}}">Dirección</label>
    <input type="text" name="{{$columns[2]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[6]}}">Teléfono</label>
    <input type="text" name="{{$columns[6]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[7]}}">Correo electrónico</label>
    <input type="text" name="{{$columns[7]}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[8]}}">Código postal</label>
    <input type="text" name="{{$columns[8]}}" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

@extends('layouts.app', ['model'=>'businesses'])
@section('title', ' - Crear Negocio')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0}
form{padding: 0 15px;}
div.alert-danger > ul{margin-bottom: 0;}
div.form-group > div.justify-content-between{width:60vw;margin:0 auto;margin-left:0;}
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul class="m-0">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('businesses.store')}}" method="post" class="mt-2">
  @csrf

  <div class="form-group">
    <label for="name">Nombre del negocio</label>
    <input type="text" name="name" class="form-control">
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
  <div class="form-group">
    <label>Horario</label>
    <div class="d-flex flex-wrap justify-content-between">
      @foreach ($days as $day)
      <div class="weekday-selector custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="weekday-{{$loop->iteration}}" id="weekday-{{$loop->iteration}}">
        <label class="custom-control-label" for="weekday-{{$loop->iteration}}">{{$day}}</label>
      </div>
      @endforeach
    </div>
  </div>
  <div class="form-group d-flex flex-wrap">
    <div class="mr-4">
      <label for="open">Hora de apertura:</label>
      <input type="time" name="open">
    </div>
    <div>
      <label for="close">Cierra a las:</label>
      <input type="time" name="close">
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

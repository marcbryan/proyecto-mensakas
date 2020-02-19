@extends('layouts.app', ['model'=>'businesses'])
@section('title', ' - Crear Negocio')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0}
form{padding: 0 15px;}
div.alert-danger > ul{margin-bottom: 0;}
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
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

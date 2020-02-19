@extends('layouts.app', ['model'=>'menus'])
@section('title', ' - Crear Menú')
@section('styles')
.row i{font-size:5vw; margin-bottom:3px}
.container{max-width:inherit;padding:0;}
form{padding: 0 15px;}
div.alert-danger > ul{margin-bottom: 0;}
@endsection
@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<form action="{{route('menus.store')}}" method="post" class="mt-2">
  @csrf

  <div class="form-group">
    <label for="name">Nombre del menú</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label for="name">Negocio que tendrá este menú: </label>
    <select class="form-control custom-select" name="name">
      @foreach ($businesses as $business)
        <option value="{{$business->id}}">{{$business->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="price">Precio</label>
    <input type="number" min="0.01" step="0.01" name="price" class="form-control" placeholder="Ej: 1.99">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

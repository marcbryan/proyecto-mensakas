@extends('layouts.logged', ['model'=>'categories'])
@section('title', ' - Crear Categoría')
@section('styles')
.row i{font-size:5vw; margin-bottom:3px}
.container{max-width:inherit;}
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

<form action="{{route('categories.store')}}" method="post" class="mt-2">
  @csrf
  <div class="form-group">
    <label for="name">Nombre de la categoría</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label for="icon">Enlace de la imagen de la categoría</label>
    <input type="text" name="icon" class="form-control">
  </div>
  <div class="form-group">
    <label for="color">Color para la categoría</label>
    <input type="color" name="color" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

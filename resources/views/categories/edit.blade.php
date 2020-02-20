@extends('layouts.app', ['model'=>'categories'])
@section('title')
 - Editar {{$category_name}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
@endsection

@component('components.confirm', ['title'=>'Eliminar categoría', 'text'=>'Estás seguro que quieres eliminar "'.$category_name.'"?'])
@endcomponent

@section('content')

<script type="text/javascript">
  $(function() {
    $('#confirmModal button#confirmButton').click(function() {
      $('form#delete').submit();
    });
  });
</script>

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

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row m-2 d-flex justify-content-end">
  <form action="{{ route('categories.destroy',$category->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Eliminar</button>
  </form>
</div>

<form action="{{ route('categories.update',$category->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="category_name">Nombre de la categoría</label>
    <input type="text" name="category_name" class="form-control" value="{{$category_name}}">
  </div>
  <div class="form-group">
    <label for="icon">Enlace de la imagen de la categoría</label>
    <input type="text" name="icon" class="form-control" value="{{$category->icon}}">
  </div>
  <div class="form-group">
    <label for="color">Color para la categoría</label>
    <input type="color" name="color" class="form-control" value="{{$category->color}}">
  </div>

  <div class="form-group">
    <div class="custom-control custom-checkbox mr-sm-2">
      @if ($category->status == 1)
      <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
      @else
      <input type="checkbox" class="custom-control-input" name="status" id="status">
      @endif
      <label class="custom-control-label" for="status">La categoría está disponible?</label>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

@extends('layouts.app', ['model'=>'menus'])
@section('title')
 - Editar {{$menu_name}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
div.alert-danger > ul{margin-bottom: 0;}
@endsection

@component('components.confirm', ['title'=>'Eliminar menú', 'text'=>'Estás seguro que quieres eliminar "'.$menu_name.'"?'])
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
  <form action="{{ route('menus.destroy',$menu->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Eliminar</button>
  </form>
</div>

<form action="{{ route('menus.update',$menu->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="menu_name">Nombre del menú</label>
    <input type="text" name="menu_name" class="form-control" value="{{$menu_name}}">
  </div>
  <div class="form-group">
    <label for="price">Precio</label>
    <input type="number" min="0.01" step="0.01" name="price" value="{{$menu->price}}" class="form-control" placeholder="Ej: 1.99">
  </div>
  <div class="form-group">
    <div class="custom-control custom-checkbox mr-sm-2">
      @if ($menu->status == 1)
      <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
      @else
      <input type="checkbox" class="custom-control-input" name="status" id="status">
      @endif
      <label class="custom-control-label" for="status">El menú está disponible?</label>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

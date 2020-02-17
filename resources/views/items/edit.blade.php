@extends('layouts.logged', ['model'=>'items'])
@section('title')
 - Editar {{$item_name}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
@endsection

@component('components.confirm', ['title'=>'Eliminar producto', 'text'=>'Estás seguro que quieres eliminar "'.$item_name.'"?'])
@endcomponent

@section('content')

<script type="text/javascript">
  $(function() {
    $('#confirmModal button#confirmButton').click(function() {
      $('form#delete').submit();
    });
    $('input[type="number"]').on('input', function(){
      let value = parseFloat(this.value);
      if (Number.isNaN(value)) {
        this.value = "";
      } else {
        this.value = value.toFixed(2);
      }
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
  <form action="{{ route('items.destroy',$item->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Eliminar</button>
  </form>
</div>

<form action="{{ route('items.update',$item->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="item_name">Nombre del producto</label>
    <input type="text" name="item_name" class="form-control" value="{{$item_name}}">
  </div>
  <div class="form-group">
    <label for="price">Precio</label>
    <input type="number" min="0.01" step="0.01" name="price" class="form-control" value="{{$item->price}}" placeholder="Ej: 1.99">
  </div>
  <div class="form-group">
    <label for="type">Tipo</label>
    <select class="form-control" name="type">
      @foreach ($types as $type)
        @if ($type->type == $item->type)
        <option value="{{$type->type}}" selected>{{$type->name}}</option>
        @else
        <option value="{{$type->type}}">{{$type->name}}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="image_url">Enlace Imagen</label>
    <input type="text" name="image_url" class="form-control" value="{{$item->image_url}}">
  </div>
  <div class="form-group">
    <div class="custom-control custom-checkbox mr-sm-2">
      @if ($item->status == 1)
      <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
      @else
      <input type="checkbox" class="custom-control-input" name="status" id="status">
      @endif
      <label class="custom-control-label" for="status">El producto está disponible?</label>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

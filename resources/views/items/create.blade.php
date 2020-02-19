@extends('layouts.app', ['model'=>'items'])
@section('title', ' - Crear Producto')
@section('styles')
.row i{font-size:5vw; margin-bottom:3px}
.container{max-width:inherit;padding:0;}
form{padding: 0 15px;}
div.alert-danger > ul{margin-bottom: 0;}
@endsection
@section('content')

<script type="text/javascript">
  $(function() {
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

<form action="{{route('items.store')}}" method="post" class="mt-2">
  @csrf

  <div class="form-group">
    <label for="name">Nombre del producto</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label for="business_id">Negocio que tendrá este producto: </label>
    <select class="form-control custom-select" name="business_id">
      @foreach ($businesses as $business)
        <option value="{{$business->id}}">{{$business->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="price">Precio</label>
    <input type="number" min="0.01" step="0.01" name="price" class="form-control" placeholder="Ej: 1.99">
  </div>
  <div class="form-group">
    <label for="type">Tipo</label>
    <select class="form-control custom-select" name="type">
      @foreach ($types as $type)
        <option value="{{$type->type}}">{{$type->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="image_url">Enlace Imagen</label>
    <input type="text" name="image_url" class="form-control" placeholder="Ej: https://mejorconsalud.com/wp-content/uploads/2013/07/patatas-fritas--500x375.jpg">
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

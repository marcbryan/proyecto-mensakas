@extends('layouts.app', ['model'=>'businesses'])
@section('title')
 - Editar {{$business->name}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
@endsection

@component('components.confirm', ['title'=>'Eliminar negocio', 'text'=>'Estás seguro que quieres eliminar el negocio "'.$business->name.'"?'])
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
  <form action="{{ route('businesses.destroy',$business->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Eliminar</button>
  </form>
</div>

<form action="{{ route('businesses.update',$business->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="name">Nombre del negocio</label>
    <input type="text" name="name" class="form-control" value="{{$business->name}}">
  </div>
  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input type="text" name="email" class="form-control" value="{{$business->email}}">
  </div>
  <div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" name="address" class="form-control" value="{{$business->address}}">
  </div>
  <div class="form-group">
    <label for="zipcode">Código postal</label>
    <input type="text" name="zipcode" class="form-control" value="{{$business->zipcode}}">
  </div>
  <div class="form-group">
    <label for="phone">Teléfono</label>
    <input type="text" name="phone" class="form-control" value="{{$business->phone}}">
  </div>
  <div class="form-group">
    <div class="custom-control custom-checkbox mr-sm-2">
      @if ($business->status == 1)
      <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
      @else
      <input type="checkbox" class="custom-control-input" name="status" id="status">
      @endif
      <label class="custom-control-label" for="status">El negocio está disponible?</label>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

@extends('layouts.app', ['model'=>'superusers'])
@section('title')
 - Editar a {{$superuser->first_name}} {{$superuser->last_name}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
div.alert-danger > ul{margin-bottom: 0;}
@endsection

@component('components.confirm', ['title'=>'Eliminar superusuario', 'text'=>'Estás seguro que quieres eliminar el superusuario de '.$superuser->first_name.' '.$superuser->last_name.'?'])
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
  <form action="{{ route('superusers.destroy',$superuser->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Eliminar</button>
  </form>
</div>

<form action="{{ route('superusers.update',$superuser->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="first_name">Nombre</label>
    <input type="text" name="first_name" class="form-control" value="{{$superuser->first_name}}">
  </div>
  <div class="form-group">
    <label for="last_name">Apellidos</label>
    <input type="text" name="last_name" class="form-control" value="{{$superuser->last_name}}">
  </div>
  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input type="text" name="email" class="form-control" value="{{$superuser->email}}">
  </div>
  <div class="form-group">
    <label for="old_pass">Antigua Contraseña</label>
    <input type="password" name="old_pass" class="form-control">
  </div>
  <div class="form-group">
    <label for="password">Nueva Contraseña</label>
    <input type="password" name="password" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

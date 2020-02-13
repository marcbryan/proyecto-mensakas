@extends('layouts.logged', ['model'=>'deliverers'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
@endsection
@section('content')

<script type="text/javascript">
  $(function() {
    $('form#delete').submit(function() {
      var resp = confirm("Estás seguro que quieres eliminar este Deliverer?");
      if (resp) {
        return true;
      }
      return false;
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

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row m-2 d-flex justify-content-end">
  <form action="{{ route('deliverers.destroy',$deliverer->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
  </form>
</div>

<form action="{{ route('deliverers.update',$deliverer->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="{{$columns[2]}}">Nombre</label>
    <input type="text" name="{{$columns[2]}}" class="form-control" value="{{$deliverer->first_name}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[3]}}">Apellidos</label>
    <input type="text" name="{{$columns[3]}}" class="form-control" value="{{$deliverer->last_name}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[4]}}">Correo electrónico</label>
    <input type="text" name="{{$columns[4]}}" class="form-control" value="{{$deliverer->email}}">
  </div>
  <div class="form-group">
    <label for="old_pass">Antigua Contraseña</label>
    <input type="password" name="old_pass" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[5]}}">Nueva Contraseña</label>
    <input type="password" name="{{$columns[5]}}" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

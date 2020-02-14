@extends('layouts.logged', ['model'=>'business'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
@endsection
@section('content')

<script type="text/javascript">
  $(function() {
    $('form#delete').submit(function() {
      var resp = confirm("Estás seguro que quieres eliminar este Business?");
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
  <form action="{{ route('business.destroy',$business->id) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
  </form>
</div>

<form action="{{ route('business.update',$business->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="{{$columns[1]}}">Nombre</label>
    <input type="text" name="{{$columns[1]}}" class="form-control" value="{{$business->name}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[2]}}">Dirección</label>
    <input type="text" name="{{$columns[2]}}" class="form-control" value="{{$business->address}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[6]}}">Teléfono</label>
    <input type="text" name="{{$columns[6]}}" class="form-control" value="{{$business->phone}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[7]}}">Correo electrónico</label>
    <input type="text" name="{{$columns[7]}}" class="form-control" value="{{$business->email}}">
  </div>
  <div class="form-group">
    <label for="{{$columns[8]}}">Código postal</label>
    <input type="text" name="{{$columns[8]}}" class="form-control" value="{{$business->zipcode}}">
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection
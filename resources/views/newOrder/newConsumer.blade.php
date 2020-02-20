@extends('layouts.app', ['model'=>'consumers'])
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form{padding: 0 15px;}
@endsection
@section('content')
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

<div class="col-6 mx-auto mt-3">
<form action="{{url('newConsumer')}}" method="post">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="first_name">Nombre</label>
    <input required type="text" name="first_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="last_name">Apellidos</label>
    <input required type="text" name="last_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input required type="text" name="email" class="form-control">
  </div>
  <div class="form-group">
    <label for="address">Dirección</label>
    <input required type="text" name="address" class="form-control">
  </div>
  <div class="form-group">
    <label for="zipcode">Código postal</label>
    <input required type="text" name="zipcode" class="form-control" minlength="5">
  </div>
  <div class="form-group">
    <label for="phone">Teléfono</label>
    <input required type="text" name="phone" class="form-control" minlength="9">
  </div>
  <input required type="submit" class="btn btn-primary" value="Acceder">
</form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
      $('.nav-link').hide();
	});
</script>

@endsection

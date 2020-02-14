@extends('layouts.logged', ['model'=>'menus'])
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

<form action="{{route('menus.store')}}" method="post" class="mt-2">
  @csrf

  <div class="form-group">
    <label for="text">Nombre del menú</label>
    <input type="text" name="text" class="form-control">
  </div>
  <div class="form-group">
    <label for="{{$columns[1]}}">Negocio que tendrá este menú: </label>
    <select class="form-control" name="{{$columns[1]}}">
      @foreach ($businesses as $business)
        <option value="{{$business->id}}">{{$business->name}}</option>
      @endforeach
    </select>
  </div>
  <input type="submit" class="btn btn-primary" value="Crear">
</form>
@endsection

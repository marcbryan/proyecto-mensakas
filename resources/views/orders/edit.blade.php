@extends('layouts.app', ['model'=>'orders'])
@section('title')
 - Editar Pedido #{{$order->id}}
@endsection
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;padding:0;}
form.mt-4{margin:0 auto;width:60vw;}
div.alert-danger > ul{margin-bottom: 0;}
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

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('orders.update',$order->id) }}" method="post" class="mt-4">
  @csrf
  @method('PUT')
  @if ($order->deliverer_id == null)
  <div class="form-group">
    <label for="deliverer_id">Deliverer de este pedido</label>
    <select class="form-control custom-select" name="deliverer_id">
      @foreach ($deliverers as $deliverer)
        @if($order->deliverer_id == $deliverer->id)
        <option value="{{$deliverer->id}}" selected>{{$deliverer->first_name}} {{$deliverer->last_name}}</option>
        @else
        <option value="{{$deliverer->id}}">{{$deliverer->first_name}} {{$deliverer->last_name}}</option>
        @endif
      @endforeach
    </select>
  </div>
  @endif
  <div class="form-group">
    <label for="status">Estado</label>
    <input type="text" name="status" class="form-control" value="{{$order->status}}">
  </div>
  <input type="submit" class="btn btn-primary" value="Actualizar">
</form>
@endsection

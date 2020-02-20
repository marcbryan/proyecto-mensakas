@extends('layouts.app')
@section('title', ' - Panel de Control')
@section('styles')
.row i{font-size:5vw; padding:3px}
@endsection
@section('content')
<script type="text/javascript">
</script>
<dir class="row mt-3 mx-0 p-0 justify-content-center">
    <div class="col-sm-3 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="{{url('PanelUsers')}}" role="button">
            <i class="fas fa-users"></i>
            <br>Usuarios
        </a>
    </div>
    <div class="col-sm-3 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="{{route('businesses.index')}}" role="button"><i class="fas fa-building"></i><br>Bussiness</a>
    </div>
    <div class="col-sm-3 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('menus.index')}}" role="button">
            <i class="fas fa-book-open"></i>
            <br>
            Menús
        </a>
    </div>
    <div class="col-sm-3 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('orders.index')}}" role="button"><i class="fas fa-list-ol"></i>
            <br>
            Pedidos
        </a>
    </div>
    <div class="col-sm-3 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('items.index')}}" role="button"><i class="fas fa-utensils"></i>
            <br>
            Productos
        </a>
    </div>
    <div class="col-sm-3 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('categories.index')}}" role="button"><i class="fas fa-briefcase"></i>
            <br>
            Categorías
        </a>
    </div>
</dir>


@endsection

@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
@endsection
@section('content')
<script type="text/javascript">
</script>
<dir class="row mt-3 mx-0 p-0 justify-content-center">
    <div class="col-sm-2 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="{{route('superusers.index')}}" role="button">
            <i class="fas fa-users"></i>
            <br>Users
        </a>
    </div>
    <div class="col-sm-2 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="{{route('businesses.index')}}" role="button"><i class="fas fa-building"></i><br>Bussiness</a>
    </div>
    <div class="col-sm-2 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('menus.index')}}" role="button">
            <i class="fas fa-book-open"></i>
            <br>
            Menu
        </a>
    </div>
    <div class="col-sm-2 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="{{route('orders.index')}}" role="button"><i class="fas fa-list-ol"></i>
            <br>
            Orders
        </a>
    </div>
    <div class="col-sm-2 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="" role="button"><i class="fas fa-map-marked"></i>
            <br>
            Delivers
        </a>
    </div>

</dir>


@endsection

@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
@endsection
@section('content')
<script type="text/javascript">
  $(function() {
    $('.nav-item').remove();
  });
</script>
<dir class="row mt-3 mx-0 p-0 justify-content-center">
    <div class="col-sm-3 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="" role="button">
            <i class="fas fa-utensils"></i>
            <br>Consumers
        </a>
    </div>
    <div class="col-sm-3 col-12 mb-2 ">
        <a class="btn btn-primary btn-block" href="" role="button"><i class="fas fa-bicycle"></i><br>Deliverers</a>
    </div>
    <div class="col-sm-3 col-12 mb-2">
        <a class="btn btn-primary btn-block" href="" role="button"><i class="fas fa-user-tie"></i>
            <br>
            Business
        </a>
    </div>

</dir>


@endsection

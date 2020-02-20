@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
	$(function() {
    $('.nav-link').remove();
	});
</script>
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
@php $business = session('business'); @endphp
@if (isset($business))
  @if (count($business) > 0)
  <form class="mt-2" action="{{url('restSelected')}}" method="post">
    @csrf
    @method('PUT')
    <label for="business_id">Selecciona uno de los restaurantes de tu zona:</label>
    <select class="form-control custom-select mb-2" name="business_id">
      @foreach ($business as $bus)
      <option value="{{$bus->id}}">{{$bus->name}}</option>
      @endforeach
    </select>
    <input type="submit" class="btn btn-primary" value="Pedir de este restaurante">
  </form>
  @else
      <div class="alert alert-danger mt-5" role="alert">
          <h4 class="alert-heading">UPS!</h4>
          <p>Lamentablemente no hay restaurantes que dispongan de nuestro servicio cerca tuyo.</p>
        </div>
  @endif
@else
  @php header("Location: /"); @endphp
@endif
@endsection

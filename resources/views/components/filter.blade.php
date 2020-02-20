@section('filter-styles')
@media (max-width: 775px) {
  .filter-form{margin-top:.5rem;}
  .filter-form > div.form-group:nth-of-type(2){flex-grow:3;}
  .filter-form > div.form-group > input[name="value"]{width:100%;}
  div.row.d-flex{flex-direction:column;}
  div.row.d-flex > a.btn-success{max-width: calc(100% - .5rem)};
}
@media (max-width: 576px) {
  .filter-form > div.form-group{margin-bottom:.5rem;}
  .filter-form > div.form-group:nth-of-type(1){width:100%;margin-right:0!important;}
  .filter-form > div.form-group:nth-of-type(1) > select{width:100%;}
  .filter-form > div.form-group:nth-of-type(2){margin-bottom:0;}
}
@endsection
<form class="form-inline mr-2 filter-form" action="/{{$model}}/filter" method="GET">
  @csrf
  <div class="form-group mr-2">
    <select class="form-control custom-select" name="column">
      @foreach ($keys as $key => $value)
      <option value="{{ $key }}">{{ $value }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group mr-2">
    <input type="text" name="value" class="form-control" placeholder="Valor a buscar">
  </div>
  <input type="submit" class="btn btn-primary" value="Buscar">
</form>

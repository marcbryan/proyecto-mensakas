@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:100vw; padding:0;}
div.row.d-flex{margin:0;flex-direction:row;justify-content:space-between;}
@endsection
@section('content')
    <script type="text/javascript">
      $(function() {
        $('.nav-item').remove();
        $('.clickable-row').click(function() {
          window.location = $(this).data("href");
        });
      });
    </script>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

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

    <div class="row my-2 ml-2 d-flex">
      <a class="btn btn-success" href="{{ route('superusers.create') }}"> Nuevo Superusuario</a>
      <form class="form-inline mr-2" action="/superusers/filter" method="GET">
        @csrf
        <div class="form-group mr-2">
          <select class="form-control" name="column">
            @foreach ($keys as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group mr-2">
          <label for="value"></label>
          <input type="text" name="value" class="form-control" placeholder="Valor a buscar">
        </div>
        <input type="submit" class="btn btn-primary" value="Buscar">
      </form>
    </div>

    <div class="table-responsive-sm">
      <table class="table table-hover">
        <tr>
          @foreach ($columns as $column)
          <th>{{ $column }}</th>
          @endforeach
        </tr>

        @foreach ($superusers as $superuser)
        <tr class='clickable-row' data-href="{{ route('superusers.edit',$superuser->id) }}">
          @foreach ($columns as $column)
          <td>{{ $superuser->$column }}</td>
          @endforeach
        </tr>
        @endforeach
      </table>
    </div>

@endsection

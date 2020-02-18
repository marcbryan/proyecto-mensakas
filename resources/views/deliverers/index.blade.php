@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:100vw; padding:0;}
.row{margin:0;}
div.row.d-flex{margin:0;flex-direction:row;justify-content:space-between;}
@endsection
@section('content')
    <script type="text/javascript">
      $(function() {
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

    <div class="row my-2 ml-2 d-flex">
      <a class="btn btn-success" href="{{ route('deliverers.create') }}"> Nuevo Deliverer</a>
      @component('components.filter', ['model' => 'deliverers', 'keys' => $keys])
      @endcomponent
    </div>

    <div class="table-responsive-sm">
      <table class="table table-hover">
        <tr>
          @foreach ($columns as $column)
          <th>{{ $column }}</th>
          @endforeach
        </tr>

        @foreach ($deliverers as $deliverer)
        <tr class='clickable-row' data-href="{{ route('deliverers.edit',$deliverer->id) }}">
          @foreach ($columns as $column)
          <td>{{ $deliverer->$column }}</td>
          @endforeach
        </tr>
        @endforeach
      </table>
    </div>

@endsection

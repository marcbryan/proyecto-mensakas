@extends('layouts.app')
@section('title', ' - Lista Pedidos')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:100vw; padding:0;}
.row{margin:0;}
div.row.d-flex{margin:0;flex-direction:row;justify-content:end;}
div.alert-danger > ul{margin-bottom: 0;}
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
      @component('components.filter', ['model' => 'orders', 'keys' => $keys])
      @endcomponent
    </div>

    <div class="table-responsive-sm">
      <table class="table table-hover">
        <tr>
          @foreach ($columns as $column=>$value)
          <th>{{ $value }}</th>
          @endforeach
        </tr>

        @foreach ($orders as $order)
        <tr class='clickable-row' data-href="{{ route('orders.edit',$order->id) }}">
          @foreach ($columns as $column=>$value)
          @if ($loop->index == 2)
          <td>{{ $order->business->name }}</td>
          @else
          <td>{{ $order->$column }}</td>
          @endif
          @endforeach
        </tr>
        @endforeach
      </table>
    </div>

@endsection

@extends('layouts.app')
@section('title', ' - Lista Productos')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:100vw; padding:0;}
.row{margin:0;}
div.row > div.col-lg-12{padding:0}
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

    <div class="row my-2 ml-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('items.create') }}"> Nuevo Producto</a>
            </div>
        </div>
    </div>

    <div class="table-responsive-sm">
      <table class="table table-hover">
        <tr>
          @foreach ($columns as $column)
            <th>{{ $column }}</th>
          @endforeach
        </tr>

        @foreach ($items as $item)
        <tr class='clickable-row' data-href="{{ route('items.edit',$item->id) }}">
          @foreach ($columns as $column)
            @if ($loop->index == 1)
            <td>{{ $item->nameIn($lang) }}</td>
            <td>{{ $item->business->name }}</td>
            @elseif ($loop->index == 5)
            <td>{{ $item->typeIn($lang) }}</td>
            @elseif ($loop->index == 0 or $loop->index > 2)
            <td>{{ $item->$column }}</td>
            @endif
          @endforeach
        </tr>
        @endforeach
      </table>
    </div>

@endsection

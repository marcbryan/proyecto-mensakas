@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
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

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    <div class="row mt-2 mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('menus.create') }}"> Nuevo Menú</a>
            </div>
        </div>
    </div>

    <div class="table-responsive-sm">
      <table class="table table-hover">
        <tr>
          @foreach ($columns as $column)
            @if ($loop->index == 1)
            <th>Nombre del menú</th>
            @endif
            <th>{{ $column }}</th>
          @endforeach
        </tr>

        @foreach ($menus as $menu)
        <tr class='clickable-row' data-href="{{ route('menus.edit',$menu->id) }}">
          @foreach ($columns as $column)
            @if ($loop->index == 1)
            <td>{{$menu->names()->where('lang', $lang)->value('text')}}</td>
            @endif
            <td>{{ $menu->$column }}</td>
          @endforeach
        </tr>
        @endforeach
      </table>
    </div>

@endsection

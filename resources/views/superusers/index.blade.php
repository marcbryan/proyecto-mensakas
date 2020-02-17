@extends('layouts.app')
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
                <a class="btn btn-success" href="{{ route('superusers.create') }}"> Nuevo Superusuario</a>
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

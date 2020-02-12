@extends('layouts.app')
@section('styles')
.row i{font-size:5vw; padding:3px}
.container{max-width:inherit;}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Example</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('superusers.create') }}"> Nuevo Superusuario</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            @foreach ($columns as $column)
              <th>{{ $column }}</th>
            @endforeach
            <th width="280px">Action</th>
        </tr>

        @foreach ($superusers as $superuser)

        <tr>
            @foreach ($columns as $column)
              <td>{{ $superuser->$column }}</td>
            @endforeach
            <td>
                <form action="{{ route('superusers.destroy',$superuser->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('superusers.show',$superuser->id) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('superusers.edit',$superuser->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection

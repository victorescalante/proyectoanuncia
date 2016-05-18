@extends('layout.default')

@section('content')
    <div class="jumbotron">
            <h3 class="text-center"> ¿Quieres eliminar <span class="text-primary">{{ $footbridge->name }}</span> ?</h3>
            <form method="post" action="{{ route('footbridge_delete_path', $footbridge->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <button class="btn btn-success center-block" type="submit">Eliminar</button>
            </form>
    </div>



@endsection
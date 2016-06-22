@extends('layout.default_system')


@section('content')
    <div class="jumbotron">
            <h3 class="text-center"> ¿Quieres eliminar <span class="text-primary">{{ $footbridge->name }}</span> ?</h3>
            <form method="post" action="{{ route('footbridge_delete_path', $footbridge->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <br>
                <div class="text-center">
                    <div class="btn-group ">
                        <a class="btn btn-default" href="{{ route('footbridge_home_path') }}">Cancelar</a>

                        <button class="btn btn-success" type="submit">Eliminar</button>
                    </div>
                </div>
            </form>
    </div>



@endsection
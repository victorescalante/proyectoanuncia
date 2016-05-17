@extends('layout.default')

@section('content')
    <div class="row">
        <h1 class="text-center">Iniciar Sesión</h1>
        <div class="col-lg-offset-1 col-lg-10">
            @include('partials.errors')
            <form action="{{ route('auth_store_path') }}" method="post">
                {{ csrf_field() }}
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" value="">
                <label for="password">Contraseña:</label>
                <input class="form-control" type="password" name="password">
                <br>
                <input class="btn btn-primary" type="submit" value="Iniciar">
            </form>
        </div>
    </div>

@endsection
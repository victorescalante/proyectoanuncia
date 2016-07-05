@extends('layout.default_auth')

@section('content')
    <div class="row">
        <div class="container login">
            <div class="center-block">
                <img class="center-block img-responsive" src="{{ url('img/system/HOME.logo_.02.png') }}">
            </div>
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-4 col-md-4">
                @include('partials.errors')
                <form action="{{ route('auth_store_path') }}" method="post">
                    {{ csrf_field() }}
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" name="email" value="">
                    <label for="password">Contraseña:</label>
                    <input class="form-control" type="password" name="password">
                    <br>
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Iniciar sessión">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
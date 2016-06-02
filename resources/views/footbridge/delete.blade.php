@extends('layout.default_system')

@section('menu')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Anuncia</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">Puentes</a></li>
                    <li><a href="#">Usuarios</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="active" href="#">Salir</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endsection

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
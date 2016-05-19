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
    

            <h1>Alta de Puente Peatonal</h1>
            @include('partials.errors')
            <form action="{{ route('footbridge_store_path') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="col-md-6">
                    <label for="availability">Disponibilidad</label>
                    <select class="form-control" name="availability">
                        <option value="Disponible" selected>Disponible</option>
                        <option value="No disponible">No disponible</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label for="order">Nº de Puente</label>
                    <input class="form-control" type="text" name="order" value="{{ old('order') }}">
                </div>
                <div class="col-md-4">
                    <label for="latitude">Latitud</label>
                    <input class="form-control" type="text" name="latitude" value="{{ old('latitude') }}">
                </div>
                <div class="col-md-4">
                    <label for="length">Longitud</label>
                    <input class="form-control" type="text" name="length" value="{{ old('length') }}">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="url">Subir archivo</label>
                        <input type="file" class="form-control" name="url" >
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <input class="btn btn-success center-block" type="submit" value="Crear">
                </div>

        </form>

@endsection
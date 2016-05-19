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

    <h1>Editando Puente <span class="text-primary">{{ $footbridge->name }}</span> </h1>
    @include('partials.errors')
    <form action="{{ route('footbridge_patch_path', $footbridge->id) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="patch">
        <div class="col-md-6">
            <label for="name">Nombre</label>
            <input class="form-control" type="text" name="name" value="{{ $footbridge->name }}">
        </div>
        <div class="col-md-6">
            <label for="availability">Disponibilidad</label>
            <select class="form-control" name="availability">
                @if($footbridge->availability == 'Disponible')
                    <option value="Disponible" selected>Disponible</option>
                    <option value="No disponible">No disponible</option>
                @else
                    <option value="Disponible">Disponible</option>
                    <option value="No disponible" selected>No disponible</option>
                @endif
            </select>
        </div>
        <div class="col-md-12">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $footbridge->description }}</textarea>
        </div>
        <div class="col-md-4">
            <label for="order">Nº de Puente</label>
            <input class="form-control" type="text" name="order" value="{{ $footbridge->order }}">
        </div>
        <div class="col-md-4">
            <label for="latitude">Latitud</label>
            <input class="form-control" type="text" name="latitude" value="{{ $footbridge->latitude }}">
        </div>
        <div class="col-md-4">
            <label for="length">Longitud</label>
            <input class="form-control" type="text" name="length" value="{{ $footbridge->length }}">
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="url">Subir archivo</label>
                <input type="file" class="form-control" name="url" value="{{ $footbridge->url }}" >
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <input class="btn btn-success center-block" type="submit" value="Actualizar">
        </div>

    </form>
@endsection
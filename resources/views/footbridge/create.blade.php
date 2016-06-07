@extends('layout.default_system')
    <link rel="stylesheet" href="{{ url("css/dropzone.css")  }}">
@section('header')

    <style>
        #map {
        height: 50%;
        }
    </style>

@endsection

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
            <a class="navbar-brand" href="{{ route('footbridge_home_path') }}">Anuncia</a>
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
    <div class="row">
        <div class="col-md-12">
            <h1>Alta de Puente Peatonal</h1>
            @include('partials.errors')
        </div>
    </div>
    <form role="form" data-toggle="validator" action="{{ route('footbridge_store_path') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group panel-form-green" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Datos generales</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group has-feedback col-md-6">
                                    <label for="name" class="control-label">Nombre </label><span class="text-danger"> (requerido) </span>
                                    <input class="form-control" type="text" name="name" placeholder="Nombre ..." value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="availability" class="control-label">Disponibilidad</label><span class="text-danger"> (requerido) </span>
                                    <select class="form-control" name="availability" required>
                                        <option value="Disponible" selected>Disponible</option>
                                        <option value="No disponible">No disponible</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">Descripción</label>
                                    <textarea class="form-control" name="description" id="description" cols="10" rows="10" placeholder="Coloca una breve descripción ...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Ubicación del puente</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="control-label">Estado:</label><span class="text-danger"> (requerido) </span>
                                        <select class="form-control" name="id_state" onChange="recargarS2(this.value)">
                                            <option disabled selected>Selecciona una opción</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="municipality" class="control-label">Municipio:</label><span class="text-danger"> (requerido) </span>
                                        <select class="form-control" name="municipality_id" id="municipalities" required>
                                            <option value="" disabled selected>Selecciona Estado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-4 form-group" >
                                    <label class="control-label">Latitud</label>
                                    <input class="form-control latitude" type="text" name="latitude" pattern="^(\-?\d+(\.\d+)?)$" placeholder="-99.23752" value="{{ old('latitude') }}"  >
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Longitud</label>
                                    <input class="form-control longitude" type="text" name="length" pattern="^(\-?\d+(\.\d+)?)$" placeholder="10.23094" value="{{ old('length') }}" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8 col-xs-12 form-group">
                                    <div class="col-xs-12">
                                        <label class="control-label">Dirección</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input class="form-control address" type="text" name="address"   value="{{ old('address') }}"  >
                                    </div>
                                    <div class="col-xs-4">
                                        <a type="button" id="btnAddress" class="btn btn-primary">Buscar Dirección</a>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Detalles del puente</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-primary">Detalle Posicionamiento</h4>
                                    <p> Solo llena los campos necesarios</p>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="position">Posición</label>
                                    <input class="form-control" type="text" name="position" placeholder="Frontal" value="{{ old('position') }}">
                                </div>
                                <div class="col-md-8">
                                    <label for="views">Vistas</label>
                                    <input class="form-control" type="text" name="views" placeholder="Norte y Sur" value="{{ old('views') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="frontal">Frontal</label>
                                    <input class="form-control" type="text" name="frontal" placeholder="43.5 x 6 mts" value="{{ old('frontal') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="crusade">Cruzada</label>
                                    <input class="form-control" type="text" name="crusade" placeholder="43.5 x 6 mts" value="{{ old('crusade') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="mega">Mega</label>
                                    <input class="form-control" type="text" name="mega" placeholder="43.5 x 6 mts" value="{{ old('mega') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="side">Lateral</label>
                                    <input class="form-control" type="text" name="side" placeholder="43.5 x 6 mts" value="{{ old('side') }}">
                                </div>
                                <div class="col-md-8">
                                    <label for="street">Avenida</label>
                                    <input class="form-control" type="text" name="street" placeholder="Bulevard Ávila Camacho / Plaza Satélite" value="{{ old('street') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <h4 class="text-primary">Detalle referencial</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="reference_c">Referencia Comercial</label>
                                    <textarea class="form-control" type="text" name="reference_c" rows="3">{{ old('reference_c') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_n">Referencia Norte</label>
                                    <textarea class="form-control" type="text" name="reference_n" rows="3">{{ old('refenrece_n') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_s">Referencia Sur</label>
                                    <textarea class="form-control" type="text" name="reference_s" rows="3">{{ old('reference_s') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="reference_o">Referencia Oriente</label>
                                    <textarea class="form-control" type="text" name="reference_o" rows="3">{{ old('reference_o') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_p">Referencia Poniente</label>
                                    <textarea class="form-control" type="text" name="reference_p" rows="3">{{ old('reference_p') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Subir imagenes</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a>
                                </div>
                                <div id="contenedor" class="col-md-12 form-group">
                                    <div class="row">
                                        <hr>
                                        <a href="#" class="eliminar">&times;</a>
                                        <div class="col-md-12">
                                            <h5 class="text-primary">Nueva imagen</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Selecciona Imagen</label>
                                            <input type="file" class="form-control" name="url[]" accept="image/jpeg,image/png">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Nombre de la imagen</label>
                                            <input type="text" class="form-control" name="name_img[]">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Orden en el que se mostrara</label>
                                            <input type="number" class="form-control" name="order_img[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <hr>
            <a class="btn btn-default" href="{{ URL::previous() }}">Regresar</a>
            <button class="btn btn-success" type="submit">Crear Puente</button>
        </div>
    </div>
    </form>

    <hr>


@endsection

@section('footer')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script src="{{ url("js/dropzone.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap" async defer></script>


@endsection
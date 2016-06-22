@extends('layout.default_system')

@section('header')

    <style>
        #map {
        height: 50%;
        }
    </style>

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
                                <div class="container_images col-md-12 form-group">
                                    <div class="file">
                                        <div class="image">
                                            <span class="glyphicon glyphicon-plus-sign add-refresh"></span>
                                            <span class="glyphicon glyphicon-trash add-delete"></span>
                                        </div>
                                        <input class="select_image" type="file" name="url[]"/>
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

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap" async defer></script>


@endsection
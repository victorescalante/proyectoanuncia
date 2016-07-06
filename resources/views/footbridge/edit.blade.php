@extends('layout.default_system')

@section('header')

    <style>
        #map {
            height: 50%;
        }
    </style>

@endsection


@section('content')

    <div class="col-md-12">
        <h1>Editando <span class="text-danger">{{ $footbridge->name }}</span></h1>
        @include('partials.errors')
    </div>
    <form role="form" data-toggle="validator" action="{{ route('footbridge_patch_path',$footbridge->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="col-md-12">
            <div class="panel-group panel-form-green" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Datos generales</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group has-feedback col-md-6">
                                    <label for="name" class="control-label">Nombre </label><span class="text-danger"> (requerido) </span>
                                    <input class="form-control" type="text" name="name" placeholder="Nombre ..." value="{{ $footbridge->name }}" required>
                                    <input type="hidden" name="url_home_catalog" value="{{ URL::previous() }}">
                                    <input type="hidden" id="id_footbridge" name="id_footbridge" value="{{ $footbridge->id }}">
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
                                    <textarea class="form-control" name="description" id="description" cols="10" rows="10" placeholder="Coloca una breve descripción ...">{{ $footbridge->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Detalles del puente</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
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
                                    <input class="form-control" type="text" name="position" placeholder="Frontal" value="{{ $footbridge->position }}">
                                </div>
                                <div class="col-md-8">
                                    <label for="views">Vistas</label>
                                    <input class="form-control" type="text" name="views" placeholder="Norte y Sur" value="{{ $footbridge->views }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="frontal">Frontal</label>
                                    <input class="form-control" type="text" name="frontal" placeholder="43.5 x 6 mts" value="{{ $footbridge->frontal }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="crusade">Cruzada</label>
                                    <input class="form-control" type="text" name="crusade" placeholder="43.5 x 6 mts" value="{{ $footbridge->crusade }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="mega">Mega</label>
                                    <input class="form-control" type="text" name="mega" placeholder="43.5 x 6 mts" value="{{ $footbridge->mega }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="side">Lateral</label>
                                    <input class="form-control" type="text" name="side" placeholder="43.5 x 6 mts" value="{{ $footbridge->side }}">
                                </div>
                                <div class="col-md-8">
                                    <label for="street">Avenida</label>
                                    <input class="form-control" type="text" name="street" placeholder="Bulevard Ávila Camacho / Plaza Satélite" value="{{ $footbridge->street }}">
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
                                    <textarea class="form-control" type="text" name="reference_c" rows="3">{{ $footbridge->reference_c }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_n">Referencia Norte</label>
                                    <textarea class="form-control" type="text" name="reference_n" rows="3">{{ $footbridge->reference_n }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_s">Referencia Sur</label>
                                    <textarea class="form-control" type="text" name="reference_s" rows="3">{{ $footbridge->reference_s }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="reference_o">Referencia Oriente</label>
                                    <textarea class="form-control" type="text" name="reference_o" rows="3">{{ $footbridge->reference_o }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_p">Referencia Poniente</label>
                                    <textarea class="form-control" type="text" name="reference_p" rows="3">{{ $footbridge->reference_p }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Ubicación del puente</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="control-label">Estado:</label><span class="text-danger"> (requerido) </span>
                                        <select class="form-control" name="id_state" onChange="recargarS2(this.value)">
                                            <option disabled >Selecciona una opción</option>
                                            @foreach($states as $state)
                                                @if($footbridge->municipality->state->id == $state->id)
                                                    <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                                @else
                                                    <option value="{{ $state->id }}" >{{ $state->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="municipality" class="control-label">Municipio:</label><span class="text-danger"> (requerido) </span>
                                        <select class="form-control" name="municipality_id" id="municipalities" required>
                                            <option value="" disabled >Selecciona Estado</option>
                                            @foreach($municipalities as $municipality)
                                                @if($footbridge->municipality->id == $municipality->id)
                                                    <option value="{{ $municipality->id }}" selected>{{ $municipality->name }}</option>
                                                @else
                                                    <option value="{{ $municipality->id }}" >{{ $municipality->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-4 form-group" >
                                    <label for="latitude" class="control-label">Latitud</label>
                                    <input class="form-control latitude" type="text" name="latitude" pattern="^(\-?\d+(\.\d+)?)$" placeholder="-99.23752" value="{{ $footbridge->latitude }}"  >
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="length" class="control-label">Longitud</label>
                                    <input class="form-control longitude" type="text" name="length" pattern="^(\-?\d+(\.\d+)?)$" placeholder="10.23094" value="{{ $footbridge->length }}" >
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Administrar imagenes</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="container_images col-md-12 form-group">
                                    @foreach($images as $image)
                                            <div class="file dragActive">
                                                <div class="image" style="background: url('{{ url($image->thumbnail_path) }}')">
                                                    <span class="glyphicon glyphicon-plus-sign add-refresh"></span>
                                                    <span class="glyphicon glyphicon-trash add-delete"></span>
                                                </div>
                                                <input class="select_image" type="file" accept="image/*" />
                                                <input class="id_img" type="text" name="id" value="{{ $image->id }}"/>
                                                <input type="text" name="order_img[]" value="{{ $image->id }}">
                                            </div>
                                    @endforeach
                                    <div class="content_file">
                                        <div class="file">
                                            <div class="image">
                                                <span class="glyphicon glyphicon-plus-sign add-refresh"></span>
                                                <span class="glyphicon glyphicon-trash add-delete"></span>
                                            </div>
                                            <input class="select_image" type="file" accept="image/*" />
                                            <input class="id_img" type="text" name="id" value="0"/>
                                            <input type="text" name="order_img[]" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <hr>
            <a class="btn btn-default" href="{{ URL::previous() }}">Cancelar</a>
            <button class="btn btn-success" type="submit">Guardar Cambios</button>
        </div>
    </form>

@endsection


@section('footer')

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap" async defer></script>


@endsection
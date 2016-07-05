@extends('layout.default_system')

@section('header')

    <style>
        #map {
            height: 50%;
        }
    </style>

@endsection


@section('content')

    <form role="form" data-toggle="validator" action="{{ route('footbridge_store_path') }}" method="post"
          enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-7">

                <h1>Alta de Puente Peatonal</h1>

                @include('partials.errors')

            </div>

            <div class="col-md-5">

                <br>

                <button class="btn btn-success pull-right" type="submit">Crear Puente</button>

            </div>

        </div>

        @include('footbridge.form')

    </form>


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
                        <div class="content_file">
                            <div class="file">
                                <div class="image">
                                    <span class="glyphicon glyphicon-plus-sign add-refresh"></span>
                                    <span class="glyphicon glyphicon-trash add-delete"></span>
                                </div>
                                <input class="select_image" type="file"/>
                                <input class="id_img" type="text" name="id" value="id"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>


@endsection

@section('footer')

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap"
            async defer></script>

@endsection
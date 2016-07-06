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

    <hr>


@endsection

@section('footer')

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap"
            async defer></script>

@endsection
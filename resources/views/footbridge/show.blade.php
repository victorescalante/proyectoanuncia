@extends('layout.default')

@section('header')

    <style>
        #map_div_show {
            height: 30%;
        }
    </style>

@endsection


@section('content')

    <div class="row show">
        <div class="col-md-12">
            <h1 class="text-center">{{ $footbridge->name }}</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($images as $image)
                        @if($image->order==1)
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        @else
                    <li data-target="#carousel-example-generic" data-slide-to="{{ ($image->order)-1 }}"></li>
                        @endif
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach($images as $image)
                        @if($image->order==1)
                        <div class="item active">
                            <img src="{{ $image->url }}" alt="...">
                        </div>
                        @else
                        <div class="item">
                            <img src="{{ $image->url }}" alt="...">
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div> <!-- Carousel -->
        </div>
        <div class="col-md-5">
            <p><b>Posición: </b> {{ $footbridge->position }}</p>
            <p><b>Vistas: </b> {{ $footbridge->views }}</p>
            <p><b>Frontal: </b> {{ $footbridge->frontal }}</p>
            <p><b>Cruzada: </b> {{ $footbridge->crusade }}</p>
            <p><b>Mega: </b> {{ $footbridge->mega }}</p>
            <p><b>Avenida: </b> {{ $footbridge->street }}</p>
            <p><b>Referencia Comercial: </b> {{ $footbridge->reference_c }}</p>
            <p><b>Municipio: </b> {{ $footbridge->position }}</p>
            <br>
            <p class="text-justify"><b>Referencia Norte: </b> {{ $footbridge->reference_n }}</p>
            <br>
            <p class="text-justify"><b>Referencia Sur: </b> {{ $footbridge->reference_s }}</p>
            <div class="invisible">
                <input type="text" id="latitude" value="{{ $footbridge->latitude }}">
                <input type="text" id="length" value="{{ $footbridge->length }}">
            </div>

        </div>
    </div>
    <div class="row show">
        <div class="col-md-12">
            <h2 class="text-primary"><span class="glyphicon glyphicon-picture"></span> Galería</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        @foreach($images as $image)
        <div class="col-xs-6 col-md-2">
            <a href="#" class="thumbnail">
                <img src="{{ $image->url }}" alt="...">
            </a>
        </div>
        @endforeach
    </div>
    <div class="row show">
        <div class="col-md-7">
            <h3><span class="glyphicon glyphicon-th-list"></span>  Relacionados</h3>
        </div>
        <div class="col-md-5">
            <h3><span class="glyphicon glyphicon-map-marker"></span>  Mapa</h3>
            <div id="map_div_show"></div>
        </div>
    </div>


@endsection


@section('footer')
    <script src="{{ URL::asset('/js/maps_show.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap" async defer></script>
@endsection



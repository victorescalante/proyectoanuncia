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
        <div class="col-md-7">
            <h1 class="text-center">{{ $footbridge->name }}</h1>
            <hr>
            @include('gallery.slider_default', ['images' => $images])
        </div>
        <div class="col-md-5 show">
            <br>
            <h3 class="text-center"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Ficha Técnica</h3>
            <br>
            @if(!empty($footbridge->position))
            <p>
                <b>Posición: </b> {{ $footbridge->position }}
            </p>
            @endif
            @if(!empty($footbridge->views))
            <p>
                <b>Vistas: </b> {{ $footbridge->views }}
            </p>
            @endif
            @if(!empty($footbridge->frontal))
            <p>
                <b>Frontal: </b> {{ $footbridge->frontal }}
            </p>
            @endif
            @if(!empty($footbridge->crusade))
            <p>
                <b>Cruzada: </b> {{ $footbridge->crusade}}
            </p>
            @endif
            @if(!empty($footbridge->mega))
            <p>
                <b>Mega: </b> {{ $footbridge->mega}}
            </p>
            @endif
            @if(!empty($footbridge->street))
            <p>
                <b>Avenida: </b> {{ $footbridge->street }}
            </p>
            @endif
            @if(!empty($footbridge->reference_c))
            <p>
                <b>Referencia Comercial: </b> {{ $footbridge->reference_c }}
            </p>
            @endif
            @if(!empty($footbridge->position))
            <p>
                <b>Municipio: </b> {{ $footbridge->position }}
            </p>
            @endif
            <br>
            @if(!empty($footbridge->reference_n))
            <p class="text-justify"><b>Referencia Norte: </b> {{ $footbridge->reference_n }}</p>
            <br>
            @endif
            @if(!empty($footbridge->reference_s))
            <p class="text-justify"><b>Referencia Sur: </b> {{ $footbridge->reference_s }}</p>
            <br>
            @endif
            @if(!empty($footbridge->reference_o))
                <p class="text-justify"><b>Referencia Oriente: </b> {{ $footbridge->reference_o }}</p>
                <br>
            @endif
            @if(!empty($footbridge->reference_p))
                <p class="text-justify"><b>Referencia Poniente: </b> {{ $footbridge->reference_p }}</p>
                <br>
            @endif
            <div class="invisible">
                <input type="text" id="latitude" value="{{ $footbridge->latitude }}">
                <input type="text" id="length" value="{{ $footbridge->length }}">
            </div>

        </div>
    </div>

    @if(count($images)<=3)
        @include('gallery.templete_with_3_images', ['images' => $images])
    @else
        @if(count($images)<=6)
            @include('gallery.templete_with_6_images', ['images' => $images])
        @endif
    @endif


@endsection


@section('js_map')
    <script src="{{ URL::asset('/js/maps_show.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxu2oAwf0cLKgO7bBpbWDzDNde90lWaTE&signed_in=true&callback=initMap" async defer></script>
@endsection

@section('footer')
    <div class="footer-page">
        <div class="container">
            <p class="text-center">Anuncia © 2016 Todos los derechos reservados.</p>
        </div>
    </div>
    @endsection





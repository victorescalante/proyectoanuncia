@extends('layout.default')

@section('content')
    @if(count($footbridges))
        <div class="container">
            <div class="row show">
                <div class="col-md-8">
                    <h1>Catálogo</h1>
                </div>
                <div class="col-md-4 search-form">
                    <form class="navbar-form navbar-right" method="post" action="{{ route('catalog_search_path') }}"
                          role="search">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <input name="search" type="text" class="form-control" placeholder="Escribe tu búsqueda">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row show">
                @foreach($footbridges as $footbridge)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="btn-img">
                                <p class="text-right"><a href="?municipality={{$footbridge->idm}}"
                                                         class="btn btn-sm btn-success">{{ $footbridge->namem }}</a></p>
                            </div>
                            <a href="{{ route('footbridge_show_path',$footbridge->id) }}"><img
                                        src="/{{ $footbridge->path }}" alt="..."></a>
                            <div class="caption">
                                <h3 class="text-center">{{ $footbridge->namef }}</h3>
                                <p class="text-center">
                                    <a href="{{ route('footbridge_show_path',$footbridge->id) }}"
                                       class="btn btn-primary" role="button"><span
                                                class="glyphicon glyphicon-chevron-right"></span>&nbsp;Más
                                        Información</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                {!! $footbridges->render() !!}
            </div>
            @else
                <div class="row show error">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="text-center">
                            <div class="col-md-12">
                                <h1>No encontramos la página solicitada</h1>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <p class="text-primary">La página que buscas no existe o ha cambiado de ubicación.</p>
                                <div class="col-md-offset-2 col-md-4">
                                    <a href="{{ route('catalog_show_path') }}" class="btn btn-success">Ir al
                                        cátalogo</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('home_show_path') }}" class="btn btn-primary">Ir a la página de
                                        inicio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
            </div>
@endsection
<div class="row show">
    <div class="col-md-7">
        <h2 class="text-primary"><span class="glyphicon glyphicon-picture"></span>&nbsp;Galería</h2>
        <hr>
        @foreach($images as $image)
            <div class="col-xs-6 col-md-6">
                <a href="#" class="thumbnail">
                    <img src="{{ $image->url }}" alt="...">
                </a>
            </div>
        @endforeach
    </div>
    <div class="col-md-5">
        <h2><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Mapa</h2>
        <hr>
        <div id="map_div_show"></div>
    </div>
</div>
<div class="row show">
    <div class="col-md-12">
    <h3><span class="glyphicon glyphicon-th-list"></span>&nbsp;Cercanos</h3>
    @foreach($footbridges_close as $footbridge_close)
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="thumbnail">
                <a href="{{ route('footbridge_show_path',$footbridge_close->id) }}">
                    <img src="{{ $footbridge_close->url }}" alt="...">
                </a>
                <div class="caption">
                    <h5><a href="{{ route('footbridge_show_path',$footbridge_close->id) }}"><span class="glyphicon glyphicon-link"></span> {{ $footbridge_close->name }}</a></h5>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

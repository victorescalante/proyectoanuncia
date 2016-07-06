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
                    <img src="{{ url($image->path)  }}" alt="...">
                </div>
            @else
                <div class="item">
                    <img src="{{ url($image->path)  }}" alt="...">
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
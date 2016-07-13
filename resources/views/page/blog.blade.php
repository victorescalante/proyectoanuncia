@extends('layout.default')

@section('content')
    <!-- Page Content -->
    <div class="container">


        <div class="row">


            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Noticias
                    <small>Recientes</small>
                </h1>

                <br>

                @if($posts)
                    @foreach($posts as $post)
                        <h2>
                            <a href="entrada/{{$post->id}}">{{ $post->title }}</a>
                        </h2>
                        <p class="lead">
                            por <a href="#">{{ $post->user->name }}</a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span>
                            Publicado {{ $post->created_at->format('j M Y , g:ia') }}</p>
                        <hr>
                        <a href="entrada/{{$post->id}}"><img class="img-responsive" src="{{ $post->image_path }}" alt=""></a>
                        <hr>
                        <p>{{ $post->extract }}</p>
                        <a class="btn btn-primary" href="entrada/{{$post->id}}">Leer más <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    @endforeach

                @endif


                <div class="text-center">
                    {!! $posts->render() !!}
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <br>

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Buscar en el blog</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>


                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Anucios</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
                        accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
    </div>
@endsection
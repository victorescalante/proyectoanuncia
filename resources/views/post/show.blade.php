@extends('layout.default')

@section('content')
    <!-- Page Content -->
    <div class="container">


        <div class="row">


            <!-- Blog Entries Column -->
            <div class="col-md-8">

                @if($post)

                <h1 class="page-header">
                    {{ $post->title }}
                </h1>

                <br>

                 <div class="col-md-12">
                     <p><span class="glyphicon glyphicon-time"></span> Publicado: {{ $post->created_at->format('j M Y , g:ia') }}</p>
                     <img class="img-responsive" src="{{ $post->image_path }}">

                     <hr>

                     {!! $post->description !!}

                     <b>Escrito por: {{ $post->user->name }}</b>
                 </div>

                @endif

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <br>
                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Noticias Anteriores</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
                        accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
    </div>
@endsection
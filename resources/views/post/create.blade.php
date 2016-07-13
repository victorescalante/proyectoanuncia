@extends('layout.default_system')

@section('header')


@endsection


@section('content')


        <div class="row">

            <div class="col-md-7">

                <h1>Nueva publicación</h1>

                @include('partials.errors')

            </div>

        </div>
        <form role="form" data-toggle="validator" action="{{ route('sistema.post.store') }}" method="post"
              enctype="multipart/form-data">

            @include('post.form', ['button' => 'Crear'])

        </form>

        <hr>


        @endsection

        @section('footer')

            <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="{{ url("js/validator.js") }}"></script>
            <script>
                CKEDITOR.replace('description');
            </script>


@endsection
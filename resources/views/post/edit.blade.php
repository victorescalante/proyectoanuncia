@extends('layout.default_system')

@section('header')


@endsection


@section('content')


    <div class="row">

        <div class="col-md-7">

            <h1>Editar publicación</h1>

            @include('partials.errors')

        </div>

    </div>
    <form role="form" data-toggle="validator" action="{{ route('sistema.post.update',$post->id) }}" method="post"
          enctype="multipart/form-data">

        @include('post.form_edit', [
        'button' => 'Guardar cambios'
        ])

    </form>

    <hr>


@endsection

@section('footer')

    <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ url("js/validator.js") }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description');
    </script>


@endsection
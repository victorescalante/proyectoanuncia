@extends('layout.default_system')


@section('header')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="container">
            <div class="col-md-10">
                <h2>Publicaciones</h2>
                <p>Estas son las publicaciones en el blog.</p>
            </div>
            <div class="col-md-2">
                <a href="{{ route('sistema.post.create') }}"><button class="btn btn-success btn-block">Nueva publicación</button></a>
            </div>
            @if(count($posts))
                <div class="col-md-12">

                    <br>
                    <table id="table_posts" class="table table-striped formatnew" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Actualizado</th>
                            <th>Autor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td><a href="#">{{ $post->title }}</a></td>
                                <td>{{ $post->updated_at }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('sistema.post.edit',$post->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                                        <a href="{{ route('footbridge_question_path',$post->id) }}"><button type="button" class="btn btn-danger">Borrar</button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Titulo</th>
                            <th>Actualizado</th>
                            <th>Autor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </tfoot>
                    </table>



                </div>
            @else
                <div class="col-md-12">
                    <h2 class="text-primary text-center">Aún no haz dado de alta un puente</h2>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_posts').DataTable({
                "language": {
                    "lengthMenu": "Se muestran   _MENU_  registros por página",
                    "zeroRecords": "No se encontró - Disculpa",
                    "info": "Estas viendo la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrados de _MAX_ registros totales)",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar :",
                    "emptyTable":     "No hay registros disponibles en la tabla",
                    "paginate": {
                        "first":      "Primera",
                        "last":       "Anterior",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                }
            });
        } );
    </script>
@endsection
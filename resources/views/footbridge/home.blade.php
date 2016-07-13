@extends('layout.default_system')


@section('header')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="container">
            <div class="col-md-10">
                <h2>Puentes</h2>
                <p>Estos son los puentes que actualmente se encuentran habilitados en la sitio web.</p>
            </div>
            <div class="col-md-2">
                <a href="{{ route('footbridge_create_path') }}"><button class="btn btn-success btn-block">Nuevo</button></a>
            </div>
            @if(count($footbridges))
            <div class="col-md-12">

                <br>
                <table id="table_footbridges" class="table table-striped formatnew" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Disponibilidad</th>
                        <th>Municipio</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($footbridges as $footbridge)
                        <tr>
                            <td><a href="{{ route('footbridge_show_path',$footbridge->id) }}">{{ $footbridge->name }}</a></td>
                            @if($footbridge->availability == 'Disponible')
                            <td class="availability">{{ $footbridge->availability }}</td>
                            @endif
                            <td>{{ $footbridge->municipality->name }}</td>
                            <td>{{ $footbridge->municipality->state->name }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('footbridge_edit_path',$footbridge->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                                    <a href="{{ route('footbridge_question_path',$footbridge->id) }}"><button type="button" class="btn btn-danger">Borrar</button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Disponibilidad</th>
                        <th>Municipio</th>
                        <th>Estado</th>
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
            $('#table_footbridges').DataTable({
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
@extends('layout.default_system')


@section('content')
    <div class="row">
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
                <table class="table table-striped formatnew">
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

                <div class="text-center">
                    {!! $footbridges->links() !!}
                </div>

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
@endsection
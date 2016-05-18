@extends('layout.default')

@section('content')
    <h1>Editando Puente <span class="text-primary">{{ $footbridge->name }}</span> </h1>
    @include('partials.errors')
    <form action="{{ route('footbridge_patch_path', $footbridge->id) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="patch">
        <label for="name">Nombre</label>
        <input class="form-control" type="text" name="name" value="{{ $footbridge->name }}">
        <label for="availability">Disponibilidad</label>
        <select class="form-control" name="availability">
            @if($footbridge->availability == 'Disponible')
            <option value="Disponible" selected>Disponible</option>
            <option value="No disponible">No disponible</option>
            @else
             <option value="Disponible">Disponible</option>
             <option value="No disponible" selected>No disponible</option>
            @endif
        </select>
        <label for="description">Descripción</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $footbridge->description }}</textarea>
        <hr>
        <input class="btn btn-success center-block" type="submit" value="Actualizar">
    </form>
@endsection
@extends('layout.default')

@section('content')
    <h1>Alta de Puente Peatonal</h1>
    @include('partials.errors')
    <form action="{{ route('footbridge_store_path') }}" method="post">
        {{ csrf_field() }}
        <label for="name">Nombre</label>
        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        <label for="availability">Disponibilidad</label>
        <select class="form-control" name="availability">
            <option value="Disponible" selected>Disponible</option>
            <option value="No disponible">No disponible</option>
        </select>
        <label for="description">Descripción</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        <hr>
        <input class="btn btn-success center-block" type="submit" value="Crear">
    </form>
@endsection

@if(count($municipalities))
    @foreach($municipalities as $municipality)
        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
    @endforeach
@else
    <option value="" selected disabled>No hay municipios</option>
@endif

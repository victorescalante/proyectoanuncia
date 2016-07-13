{{ csrf_field() }}
{{ method_field('PATCH') }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}" required>
        </div>
    </div>
    <div class="col-md-6">
        <label typeof="author">Autor:</label>
        <input type="text" class="form-control" name="author" value="{{ $currentUser->name }}" disabled>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Contenido:</label>
                    <textarea class="form-control" name="description" id="description" rows="10" cols="80" required>
                        {{ $post->description }}
                    </textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="extract">Extracto:</label>
            <textarea class="form-control" rows="5" name="extract" required>{{ $post->extract  }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="image_path">Imagen:</label>
            <input type="file" class="form-control" id="image_path" name="image_path"
                   value="{{ old('image_path') }}">
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-success">{{ $button }}</button>
    </div>
</div>
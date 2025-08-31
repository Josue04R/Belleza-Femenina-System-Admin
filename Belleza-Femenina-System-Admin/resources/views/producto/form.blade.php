<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombreProducto" class="form-label">{{ __('Nombre del producto') }}</label>
            <input type="text" name="nombreProducto" class="form-control @error('nombreProducto') is-invalid @enderror" 
                   value="{{ old('nombreProducto', $producto?->nombreProducto) }}" id="nombreProducto" placeholder="producto">
            {!! $errors->first('nombreProducto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="marcaProducto" class="form-label">{{ __('Marca ') }}</label>
            <input type="text" name="marcaProducto" class="form-control @error('marcaProducto') is-invalid @enderror" 
                   value="{{ old('marcaProducto', $producto?->marcaProducto) }}" id="marcaProducto" placeholder="Marca ">
            {!! $errors->first('marcaProducto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="idCategoria" class="form-label">{{ __('Categoría') }}</label>
            <select name="idCategoria" id="idCategoria" class="form-control @error('idCategoria') is-invalid @enderror">
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->idCategoria }}" 
                        {{ old('idCategoria', $producto?->idCategoria) == $categoria->idCategoria ? 'selected' : '' }}>
                        {{ $categoria->categoria }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('idCategoria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="material" class="form-label">{{ __('Material') }}</label>
            <input type="text" name="material" class="form-control @error('material') is-invalid @enderror" 
                   value="{{ old('material', $producto?->material) }}" id="material" placeholder="Material">
            {!! $errors->first('material', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                   value="{{ old('descripcion', $producto?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" 
                   value="{{ old('precio', $producto?->precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="imagen" class="form-label">{{ __('Imagen') }}</label>
            <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" id="imagen">
            {!! $errors->first('imagen', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" 
                   value="{{ old('estado', $producto?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-submit">{{ __('Submit') }}</button>
    </div>
</div>

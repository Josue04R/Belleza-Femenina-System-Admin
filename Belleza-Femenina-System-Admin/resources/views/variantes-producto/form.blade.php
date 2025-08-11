<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_producto" class="form-label">{{ __('Nombre Producto') }}</label>
            <select name="id_producto" id="id_producto" class="form-control @error('id_producto') is-invalid @enderror">
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}"
                        {{ old('id_producto', $variantesProducto?->id_producto) == $producto->id_producto ? 'selected' : '' }}>
                        {{ $producto->nombre_p }} 
                    </option>
                @endforeach
            </select>
            {!! $errors->first('id_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="id_talla" class="form-label">{{ __('Talla') }}</label>
            <select name="id_talla" id="id_talla" class="form-control @error('id_talla') is-invalid @enderror">
                <option value="">-- Selecciona una talla --</option>
                @foreach($tallas as $talla)
                    <option value="{{ $talla->id_talla }}"
                        {{ old('id_talla', $variantesProducto?->id_talla) == $talla->id_talla ? 'selected' : '' }}>
                        {{ $talla->talla }} 
                    </option>
                @endforeach
            </select>
            {!! $errors->first('id_talla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="color" class="form-label">{{ __('Color') }}</label>
            <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $variantesProducto?->color) }}" id="color" placeholder="Color">
            {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="stock" class="form-label">{{ __('Stock') }}</label>
            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $variantesProducto?->stock) }}" id="stock" placeholder="Stock">
            {!! $errors->first('stock', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $variantesProducto?->precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
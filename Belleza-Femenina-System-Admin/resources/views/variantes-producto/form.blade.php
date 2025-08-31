<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="idProducto" class="form-label">{{ __('Nombre Producto') }}</label>
            <select name="idProducto" id="idProducto" class="form-control @error('idProducto') is-invalid @enderror">
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->idProducto }}"
                        {{ old('idProducto', $variantesProducto?->idProducto) == $producto->idProducto ? 'selected' : '' }}>
                        {{ $producto->nombreProducto }} 
                    </option>
                @endforeach
            </select>
            {!! $errors->first('idProducto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="idTalla" class="form-label">{{ __('Talla') }}</label>
            <select name="idTalla" id="idTalla" class="form-control @error('idTalla') is-invalid @enderror">
                <option value="">-- Selecciona una talla --</option>
                @foreach($tallas as $talla)
                    <option value="{{ $talla->idTalla }}"
                        {{ old('idTalla', $variantesProducto?->idTalla) == $talla->idTalla ? 'selected' : '' }}>
                        {{ $talla->talla }} 
                    </option>
                @endforeach
            </select>
            {!! $errors->first('idTalla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
        <button type="submit" class="btn btn-submit">{{ __('Submit') }}</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#id_producto').change(function() {
        let productoId = $(this).val();

        if(productoId) {
            $.ajax({
                url: '/producto-datos/' + productoId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#color').val(data.color);
                    $('#precio').val(data.precio);
                    $('#stock').val(data.stock);
                },
                error: function() {
                    alert('Error al obtener datos del producto');
                    $('#color').val('');
                    $('#precio').val('');
                    $('#stock').val('');
                }
            });
        } else {
            $('#color').val('');
            $('#precio').val('');
            $('#stock').val('');
        }
    });
});
</script>

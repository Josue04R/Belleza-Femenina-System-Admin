<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_producto" class="form-label">{{ __('Id Producto') }}</label>
            <input type="text" name="id_producto" class="form-control @error('id_producto') is-invalid @enderror" value="{{ old('id_producto', $producto?->id_producto) }}" id="id_producto" placeholder="Id Producto">
            {!! $errors->first('id_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre_p" class="form-label">{{ __('Nombre P') }}</label>
            <input type="text" name="nombre_p" class="form-control @error('nombre_p') is-invalid @enderror" value="{{ old('nombre_p', $producto?->nombre_p) }}" id="nombre_p" placeholder="Nombre P">
            {!! $errors->first('nombre_p', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="marca_p" class="form-label">{{ __('Marca P') }}</label>
            <input type="text" name="marca_p" class="form-control @error('marca_p') is-invalid @enderror" value="{{ old('marca_p', $producto?->marca_p) }}" id="marca_p" placeholder="Marca P">
            {!! $errors->first('marca_p', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_cate" class="form-label">{{ __('Id Cate') }}</label>
            <input type="text" name="id_cate" class="form-control @error('id_cate') is-invalid @enderror" value="{{ old('id_cate', $producto?->id_cate) }}" id="id_cate" placeholder="Id Cate">
            {!! $errors->first('id_cate', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="material" class="form-label">{{ __('Material') }}</label>
            <input type="text" name="material" class="form-control @error('material') is-invalid @enderror" value="{{ old('material', $producto?->material) }}" id="material" placeholder="Material">
            {!! $errors->first('material', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $producto?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $producto?->precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="imagen" class="form-label">{{ __('Imagen') }}</label>
            <input type="text" name="imagen" class="form-control @error('imagen') is-invalid @enderror" value="{{ old('imagen', $producto?->imagen) }}" id="imagen" placeholder="Imagen">
            {!! $errors->first('imagen', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $producto?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_permiso" class="form-label">{{ __('Idpermiso') }}</label>
            <input type="text" name="idPermiso" class="form-control @error('idPermiso') is-invalid @enderror" value="{{ old('idPermiso', $permiso?->idPermiso) }}" id="id_permiso" placeholder="Idpermiso">
            {!! $errors->first('idPermiso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre_permiso" class="form-label">{{ __('Nombrepermiso') }}</label>
            <input type="text" name="nombrePermiso" class="form-control @error('nombrePermiso') is-invalid @enderror" value="{{ old('nombrePermiso', $permiso?->nombrePermiso) }}" id="nombre_permiso" placeholder="Nombrepermiso">
            {!! $errors->first('nombrePermiso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="categoria_productos" class="form-label">{{ __('Categoriaproductos') }}</label>
            <input type="text" name="categoriaProductos" class="form-control @error('categoriaProductos') is-invalid @enderror" value="{{ old('categoriaProductos', $permiso?->categoriaProductos) }}" id="categoria_productos" placeholder="Categoriaproductos">
            {!! $errors->first('categoriaProductos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="productos" class="form-label">{{ __('Productos') }}</label>
            <input type="text" name="productos" class="form-control @error('productos') is-invalid @enderror" value="{{ old('productos', $permiso?->productos) }}" id="productos" placeholder="Productos">
            {!! $errors->first('productos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tallas" class="form-label">{{ __('Tallas') }}</label>
            <input type="text" name="tallas" class="form-control @error('tallas') is-invalid @enderror" value="{{ old('tallas', $permiso?->tallas) }}" id="tallas" placeholder="Tallas">
            {!! $errors->first('tallas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="variantes_producto" class="form-label">{{ __('Variantesproducto') }}</label>
            <input type="text" name="variantesProducto" class="form-control @error('variantesProducto') is-invalid @enderror" value="{{ old('variantesProducto', $permiso?->variantesProducto) }}" id="variantes_producto" placeholder="Variantesproducto">
            {!! $errors->first('variantesProducto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="empleados" class="form-label">{{ __('Empleados') }}</label>
            <input type="text" name="empleados" class="form-control @error('empleados') is-invalid @enderror" value="{{ old('empleados', $permiso?->empleados) }}" id="empleados" placeholder="Empleados">
            {!! $errors->first('empleados', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="permisos" class="form-label">{{ __('Permisos') }}</label>
            <input type="text" name="permisos" class="form-control @error('permisos') is-invalid @enderror" value="{{ old('permisos', $permiso?->permisos) }}" id="permisos" placeholder="Permisos">
            {!! $errors->first('permisos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="registro_ventas" class="form-label">{{ __('Registroventas') }}</label>
            <input type="text" name="registroVentas" class="form-control @error('registroVentas') is-invalid @enderror" value="{{ old('registroVentas', $permiso?->registroVentas) }}" id="registro_ventas" placeholder="Registroventas">
            {!! $errors->first('registroVentas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ventas" class="form-label">{{ __('Ventas') }}</label>
            <input type="text" name="ventas" class="form-control @error('ventas') is-invalid @enderror" value="{{ old('ventas', $permiso?->ventas) }}" id="ventas" placeholder="Ventas">
            {!! $errors->first('ventas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="compras" class="form-label">{{ __('Compras') }}</label>
            <input type="text" name="compras" class="form-control @error('compras') is-invalid @enderror" value="{{ old('compras', $permiso?->compras) }}" id="compras" placeholder="Compras">
            {!! $errors->first('compras', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pedidos" class="form-label">{{ __('Pedidos') }}</label>
            <input type="text" name="pedidos" class="form-control @error('pedidos') is-invalid @enderror" value="{{ old('pedidos', $permiso?->pedidos) }}" id="pedidos" placeholder="Pedidos">
            {!! $errors->first('pedidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="gastos_operativos" class="form-label">{{ __('Gastosoperativos') }}</label>
            <input type="text" name="gastosOperativos" class="form-control @error('gastosOperativos') is-invalid @enderror" value="{{ old('gastosOperativos', $permiso?->gastosOperativos) }}" id="gastos_operativos" placeholder="Gastosoperativos">
            {!! $errors->first('gastosOperativos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="inventario" class="form-label">{{ __('Inventario') }}</label>
            <input type="text" name="inventario" class="form-control @error('inventario') is-invalid @enderror" value="{{ old('inventario', $permiso?->inventario) }}" id="inventario" placeholder="Inventario">
            {!! $errors->first('inventario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="clientes" class="form-label">{{ __('Clientes') }}</label>
            <input type="text" name="clientes" class="form-control @error('clientes') is-invalid @enderror" value="{{ old('clientes', $permiso?->clientes) }}" id="clientes" placeholder="Clientes">
            {!! $errors->first('clientes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="nombre_permiso" class="form-label">{{ __('Nombre del Permiso') }}</label>
            <input type="text" 
                   name="nombrePermiso" 
                   class="form-control @error('nombrePermiso') is-invalid @enderror" 
                   value="{{ old('nombrePermiso', $permiso?->nombrePermiso) }}" 
                   id="nombre_permiso" 
                   placeholder="Ej: Administrador">
            {!! $errors->first('nombrePermiso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Gestión de Productos --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="gestionProductos" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="gestionProductos" 
                   name="gestionProductos" 
                   value="1"
                   {{ old('gestionProductos', $permiso?->gestionProductos) ? 'checked' : '' }}>
            <label class="form-check-label" for="gestionProductos">Gestión de Productos</label>
        </div>

        {{-- Empleados --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="empleados" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="empleados" 
                   name="empleados" 
                   value="1"
                   {{ old('empleados', $permiso?->empleados) ? 'checked' : '' }}>
            <label class="form-check-label" for="empleados">Empleados</label>
        </div>

        {{-- Permisos --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="permisos" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="permisos" 
                   name="permisos" 
                   value="1"
                   {{ old('permisos', $permiso?->permisos) ? 'checked' : '' }}>
            <label class="form-check-label" for="permisos">Permisos</label>
        </div>

        {{-- Registro Ventas --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="registroVentas" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="registroVentas" 
                   name="registroVentas" 
                   value="1"
                   {{ old('registroVentas', $permiso?->registroVentas) ? 'checked' : '' }}>
            <label class="form-check-label" for="registroVentas">Ingreso de Ventas</label>
        </div>

        {{-- Ventas --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="ventas" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="ventas" 
                   name="ventas" 
                   value="1"
                   {{ old('ventas', $permiso?->ventas) ? 'checked' : '' }}>
            <label class="form-check-label" for="ventas">Ventas</label>
        </div>

        {{-- Compras --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="compras" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="compras" 
                   name="compras" 
                   value="1"
                   {{ old('compras', $permiso?->compras) ? 'checked' : '' }}>
            <label class="form-check-label" for="compras">Compras</label>
        </div>

        {{-- Pedidos --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="pedidos" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="pedidos" 
                   name="pedidos" 
                   value="1"
                   {{ old('pedidos', $permiso?->pedidos) ? 'checked' : '' }}>
            <label class="form-check-label" for="pedidos">Pedidos</label>
        </div>

        {{-- Gastos Operativos --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="gastosOperativos" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="gastosOperativos" 
                   name="gastosOperativos" 
                   value="1"
                   {{ old('gastosOperativos', $permiso?->gastosOperativos) ? 'checked' : '' }}>
            <label class="form-check-label" for="gastosOperativos">Gastos Operativos</label>
        </div>

        {{-- Inventario --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="inventario" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="inventario" 
                   name="inventario" 
                   value="1"
                   {{ old('inventario', $permiso?->inventario) ? 'checked' : '' }}>
            <label class="form-check-label" for="inventario">Inventario</label>
        </div>

        {{-- Clientes --}}
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="clientes" value="0">
            <input class="form-check-input" 
                   type="checkbox" 
                   id="clientes" 
                   name="clientes" 
                   value="1"
                   {{ old('clientes', $permiso?->clientes) ? 'checked' : '' }}>
            <label class="form-check-label" for="clientes">Gestión Clientes</label>
        </div>

    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-submit">{{ __('Guardar') }}</button>
    </div>
</div>

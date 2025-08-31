<div class="row padding-1 p-1">
    <div class="col-md-12">

        
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" 
                   value="{{ old('fecha', $gastosOperativo?->fecha) }}" id="fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-2 mb20">
            <label for="categoria" class="form-label">{{ __('Categoria') }}</label>
            <input type="text" name="categoria" class="form-control @error('categoria') is-invalid @enderror" 
                   value="{{ old('categoria', $gastosOperativo?->categoria) }}" id="categoria" placeholder="Categoria">
            {!! $errors->first('categoria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                   value="{{ old('descripcion', $gastosOperativo?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-2 mb20">
            <label for="monto" class="form-label">{{ __('Monto') }}</label>
            <input type="number" step="0.01" name="monto" class="form-control @error('monto') is-invalid @enderror" 
                   value="{{ old('monto', $gastosOperativo?->monto) }}" id="monto" placeholder="Monto">
            {!! $errors->first('monto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-2 mb20">
            <label for="metodoPago" class="form-label">{{ __('Metodo Pago') }}</label>
            <input type="text" name="metodoPago" 
                   class="form-control @error('metodoPago') is-invalid @enderror" 
                   value="{{ old('metodoPago', $gastosOperativo?->metodoPago) }}" 
                   id="metodoPago" placeholder="Metodo Pago" 
                   pattern="[A-Za-z\s]+" title="Solo letras">
            {!! $errors->first('metodoPago', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        
        <div class="form-group mb-2 mb20">
            <label for="idEmpleado" class="form-label">{{ __('Empleado Responsable') }}</label>
            <select name="idEmpleado" id="idEmpleado" 
                    class="form-control @error('idEmpleado') is-invalid @enderror">
                <option value="">-- Selecciona un empleado --</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->idEmpleado }}" 
                        {{ old('idEmpleado', $gastosOperativo?->idEmpleado) == $empleado->idEmpleado ? 'selected' : '' }}>
                        {{ $empleado->nombre }} {{ $empleado->apellido }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('idEmpleado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

      
        <div class="form-group mb-2 mb20">
            <label for="observaciones" class="form-label">{{ __('Observaciones') }}</label>
            <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" 
                   value="{{ old('observaciones', $gastosOperativo?->observaciones) }}" id="observaciones" placeholder="Observaciones">
            {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-submit">{{ __('Submit') }}</button>
    </div>
</div>

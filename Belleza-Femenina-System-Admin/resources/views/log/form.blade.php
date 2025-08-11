<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_log" class="form-label">{{ __('Idlog') }}</label>
            <input type="text" name="idLog" class="form-control @error('idLog') is-invalid @enderror" value="{{ old('idLog', $log?->idLog) }}" id="id_log" placeholder="Idlog">
            {!! $errors->first('idLog', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_empleado" class="form-label">{{ __('Idempleado') }}</label>
            <input type="text" name="idEmpleado" class="form-control @error('idEmpleado') is-invalid @enderror" value="{{ old('idEmpleado', $log?->idEmpleado) }}" id="id_empleado" placeholder="Idempleado">
            {!! $errors->first('idEmpleado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="accion" class="form-label">{{ __('Accion') }}</label>
            <input type="text" name="accion" class="form-control @error('accion') is-invalid @enderror" value="{{ old('accion', $log?->accion) }}" id="accion" placeholder="Accion">
            {!! $errors->first('accion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $log?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
<div class="row padding-1 p-1">
    <div class="col-md-12">
    
        <div class="form-group mb-2 mb20">
            <label for="talla" class="form-label">{{ __('Talla') }}</label>
            <input type="text" name="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla', $talla?->talla) }}" id="talla" placeholder="Talla">
            {!! $errors->first('talla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
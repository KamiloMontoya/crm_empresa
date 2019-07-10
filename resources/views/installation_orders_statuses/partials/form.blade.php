<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="form-group">
            <label>Nombre Corto</label>
            <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($installation_orders_status) ? $installation_orders_status->name : old('name') }}" {{ isset($installation_orders_status) ? 'readonly' : '' }} placeholder="Nombre">
            @if($errors->has("name"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("name") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control @if($errors->has('long_name')) is-invalid @endif" name="long_name" value="{{ isset($installation_orders_status) ? $installation_orders_status->long_name : old('long_name') }}" placeholder="Nombre">
            @if($errors->has("long_name"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("long_name") }}</div>
            @endif
        </div>


        <div class="form-group">
            <?php $checked = isset($installation_orders_status) ? $installation_orders_status->is_default : old('is_default') ?>
            <label for="cbox2">Estado por defecto ?</label>
            <input type="checkbox" name="is_default" class="form-control @if($errors->has('is_default')) is-invalid @endif" {{ $checked ? 'checked' : '' }} value="1"> 

            <span style="font-size: 0.9em"> * Si se marca esta casilla este será el estado con el que se cree un nuevo servicio </span>
            @if($errors->has("is_default"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("is_default") }}</div>
            @endif
        </div>
</div>

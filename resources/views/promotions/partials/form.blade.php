<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($promotion) ? $promotion->name : old('name') }}" placeholder="Nombre">
            @if($errors->has("name"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("name") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea type="text" class="form-control @if($errors->has('description')) is-invalid @endif" name="description" placeholder="Descripción">{{ isset($promotion) ? $promotion->description : old('description') }}</textarea>
            @if($errors->has("description"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("description") }}</div>
            @endif
        </div>


        <div class="form-group">
            <label>Porcentaje de descuento</label>
            <input type="text" class="form-control @if($errors->has('discount')) is-invalid @endif" name="discount" value="{{ isset($promotion) ? $promotion->discount : old('discount') }}" placeholder="1">
            @if($errors->has("discount"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("discount") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Cantidad de cobros para el descuento</label>
            <input type="text" class="form-control @if($errors->has('discount_period')) is-invalid @endif" name="discount_period" value="{{ isset($promotion) ? $promotion->discount_period : old('discount_period') }}" placeholder="1">

            <span style="font-size: 0.9em"> * Hace referencia a la cantidad de cobros de facturación en la que el descuento estará activo </span>
            @if($errors->has("discount_period"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("discount_period") }}</div>
            @endif
        </div>

       

        <div class="form-group">
            <?php $checked = isset($promotion) ? $promotion->active : 1 ?>
            <label for="cbox2">Descuento ctivo ?</label>
            <input type="checkbox" name="active" class="form-control @if($errors->has('active')) is-invalid @endif" {{ $checked ? 'checked' : '' }} value="1"> 
            @if($errors->has("active"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("active") }}</div>
            @endif
        </div>
</div>

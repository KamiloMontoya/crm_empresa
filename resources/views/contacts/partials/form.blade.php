<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
	<div class="col-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control @if($errors->has('first_name')) is-invalid @endif" name="first_name" value="{{ isset($contact) ? $contact->first_name : old('first_name') }}" placeholder="Nombre">
            @if($errors->has("first_name"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("first_name") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ isset($contact) ? $contact->email : old('email') }}" placeholder="Email">
            @if($errors->has("email"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("email") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" class="form-control @if($errors->has('address')) is-invalid @endif" name="address" value="{{ isset($contact) ? $contact->address :  old('address') }}" placeholder="Dirección">
            @if($errors->has("address"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("address") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>Ciudad</label>

            
            <select data-live-search="true" class="form-control selectpicker @if($errors->has('city')) is-invalid @endif" name="city" >
                <?php $city_value = isset($contact) ? $contact->city :  old('city'); ?>
                @foreach(  \App\Models\Cities\City::pluck('description')->toArray() as $key => $value )
                    <option value="{{ $value }}" {{ ($city_value == "$value") ? 'selected="true"' : '' }}> {{ $value }}</option>
                @endforeach
            </select>
           
            @if($errors->has("city"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("city") }}</div>
            @endif
        </div>

	</div>
	
	<div class="col-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group">
            <label>Apellido</label>
            <input type="text" class="form-control @if($errors->has('last_name')) is-invalid @endif" name="last_name" value="{{ isset($contact) ? $contact->last_name :  old('last_name') }}" placeholder="Apellido">
            @if($errors->has("last_name"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("last_name") }}</div>
            @endif
        </div>
	

		<div class="form-group">
            <label>Telefono</label>
            <input type="text" class="form-control @if($errors->has('phone')) is-invalid @endif" name="phone" value="{{ isset($contact) ? $contact->phone :  old('phone') }}" placeholder="">
            @if($errors->has("phone"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("phone") }}</div>
            @endif
        </div>


        <div class="form-group">
            <label>Celular</label>
            <input type="text" class="form-control @if($errors->has('celphone')) is-invalid @endif" name="celphone" value="{{  isset($contact) ? $contact->celphone : old('celphone') }}" placeholder="">
            @if($errors->has("celphone"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("celphone") }}</div>
            @endif
        </div>

    </div>
</div>


@section('scripts')
    @parent
        <script type="text/javascript">


        </script>

@endsection
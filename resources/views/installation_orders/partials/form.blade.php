<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="contact_has_service_id" value="{{ $installation_order->contact_has_service_id }}">
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <b> CUS: </b> {{ $installation_order->contactHasService->cus }}

        </div>
    </div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-6">
		
        @if($installation_order->contactHasService->Contact)
        <div class="form-group">
            <b> Cliente: </b> {{ $installation_order->contactHasService->Contact->first_name }} {{ $installation_order->contactHasService->Contact->last_name }}
        </div>
        <div class="form-group">
            <b> Dirección: </b> {{ $installation_order->contactHasService->Contact->address }}
        </div>
        <div class="form-group">
            <b> Ciudad: </b> {{ $installation_order->contactHasService->Contact->city }} 
        </div>
        @endif

        <div class="form-group">
            <label>Estado</label>
            
            <select data-live-search="true" class="form-control  @if($errors->has('status')) is-invalid @endif" name="status" >
                <?php $status_value = isset($installation_order) ? $installation_order->status :  old('status'); ?>
                @foreach(  \App\Models\InstallationOrders\InstallationOrder::getStatus() as $key => $value )
                    <option value="{{ $value }}" {{ ($status_value == "$value") ? 'selected="true"' : '' }}> {{ $value }}</option>
                @endforeach
            </select>
           
            @if($errors->has("status"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("status") }}</div>
            @endif
        </div>

	</div>
	
	<div class="col-12 col-sm-6 col-md-6 col-lg-6">
		@if($installation_order->contactHasService->Contact)
            <div class="form-group">
                <b> Telefono: </b> {{ $installation_order->contactHasService->Contact->phone }} 
            </div>
            <div class="form-group">
                <b> Celular: </b> {{ $installation_order->contactHasService->Contact->celphone }}
            </div>
            <div class="form-group">
                <b> Email: </b> {{ $installation_order->contactHasService->Contact->email }}
            </div>
        @endif

    </div>
</div>

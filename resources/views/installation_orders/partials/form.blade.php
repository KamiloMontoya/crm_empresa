<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="contact_has_service_id" value="{{ $installation_order->contact_has_service_id }}">
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small><b> CUS: </b> {{ $installation_order->contactHasService->cus }}</small>
        </div>
    </div>
	<div class="col-12 col-sm-5 col-md-5 col-lg-5">
		
        @if($installation_order->contactHasService->Contact)
            <div class="form-group">
                <small><b> Cliente: </b> {{ $installation_order->contactHasService->Contact->first_name }} {{ $installation_order->contactHasService->Contact->last_name }}</small>
                <br>
                <small><b> Dirección: </b> {{ $installation_order->contactHasService->Contact->address }}</small>
                <br>
                <small><b> Ciudad: </b> {{ $installation_order->contactHasService->Contact->city }} </small>
            </div>
        @endif

        

	</div>
	
	<div class="col-12 col-sm-7 col-md-7 col-lg-7">
		@if($installation_order->contactHasService->Contact)
            <div class="form-group">
                <small><b> Telefono: </b> {{ $installation_order->contactHasService->Contact->phone }} </small>
                <br>
                <small><b> Celular: </b> {{ $installation_order->contactHasService->Contact->celphone }}</small>
                <br>
                <small><b> Email: </b> {{ $installation_order->contactHasService->Contact->email }}</small>
            </div>
        @endif
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label><b>Estado</b></label>
            
            <select data-live-search="true" class="form-control  @if($errors->has('comment')) is-invalid @endif" name="status" >
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
    <div class="col-12">

        <div class="form-group">
            <label><b>Comentario</b></label>
            
            <textarea type="text" class="form-control @if($errors->has('comment')) is-invalid @endif" name="comment" value="{{  old('comment') }}" placeholder=""> </textarea>

            @if($errors->has("comment"))
                <div class="invalid-feedback" style="display:block">{{ $errors->first("comment") }}</div>
            @endif
        </div>
        
        <div class="form-group">
            <label><b>Adjuntos</b></label>
            <br>
            <input name="file_one" type="file"  style="font-size: 0.8em"/>
            <br>
            <input name="file_two" type="file"  style="font-size: 0.8em" />
        </div> 

       

    </div>
</div>


@section('scripts')

    @parent
        <script>
            tinymce.init({
                selector: 'textarea',  // change this value according to your HTML
                plugins : ''
            });</script>
@endsection
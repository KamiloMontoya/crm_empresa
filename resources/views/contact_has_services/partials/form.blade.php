<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small><b> CUS: </b> {{ $contact_has_service->cus }}</small>
        </div>
    </div>
	<div class="col-12 col-sm-5 col-md-5 col-lg-5">
		
        @if($contact_has_service->Contact)
            <div class="form-group">
                <small><b> Cliente: </b> {{ $contact_has_service->Contact->first_name }} {{ $contact_has_service->Contact->last_name }}</small>
                <br>
                <small><b> Dirección: </b> {{ $contact_has_service->Contact->address }}</small>
                <br>
                <small><b> Ciudad: </b> {{ $contact_has_service->Contact->city }} </small>
                <br>
                <small>
                    <b> Orden de instalación: </b> {{ $contact_has_service->installationOrder ? 'SI' : 'NO' }}
                    @if(!$contact_has_service->installationOrder)
                        <a class="btn btn-sm btn-warning generate-installation-order" data-toggle="tooltip" data-cus="{{$contact_has_service->cus}}" title="Generar Orden de Instalación" ><i class="fa fa-briefcase "></i> Crear orden de instalación</a>
                    @endif
                 </small>
                
            </div>
        @endif

        

	</div>
	
	<div class="col-12 col-sm-7 col-md-7 col-lg-7">
		@if($contact_has_service->Contact)
            <div class="form-group">
                <small><b> Telefono: </b> {{ $contact_has_service->Contact->phone }} </small>
                <br>
                <small><b> Celular: </b> {{ $contact_has_service->Contact->celphone }}</small>
                <br>
                <small><b> Email: </b> {{ $contact_has_service->Contact->email }}</small>
                <br>
                <small><b> Promoción: </b> {{ $contact_has_service->Promotion ? $contact_has_service->Promotion->name : '-' }}</small>
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
                <?php $status_value = isset($contact_has_service) ? $contact_has_service->status :  old('status'); ?>
                @foreach(  \App\Models\ContactHasServices\ContactHasService::getStatus() as $key => $value )
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
            });

            $(".generate-installation-order").click(function(event) {
                var element = $(this);

                var cus = element.attr('data-cus');

                if (cus){
                    swal({
                        title: "Está seguro?",
                        text: "Desea generar una orden de instalación para este servicio?",
                        icon: "warning",
                        buttons: [
                            'No, cancelar!',
                            'Si, Estoy seguro!'
                        ],
                        dangerMode: true,
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            swal( {
                                type: "info",
                                text: "Procesando",
                                title: "Por favor espere",
                                button: false,
                            });

                            $.ajax({
                               type: "GET",
                               url: "{{ route('installation_orders.store') }}",
                               dataType: "JSON",
                               data: {format: "json", cus: cus }, // serializes the form's elements.
                               success: function(data)
                               {
                                   swal( {
                                        type: "success",
                                        title: "Guardado exitoso",
                                        text: "Se ha generado una orden de instalación para este CUS"
                                    });
                               },
                               error: function(data)
                               {
                                    var message = '';

                                    if (data.message){
                                        message = data.message
                                    }

                                    if (data.responseJSON){
                                        message = data.responseJSON.message
                                    }
                                   swal('Error', message, 'error');
                               }
                            });
                        } 
                    });
                }
            });

        </script>
@endsection
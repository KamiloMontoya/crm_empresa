
<div class="card-body px-0">
	<div id="accordionContactServices">
		<div class="card">
		    <div class="card-header bg-primary" id="headingOne">
		      	<span class="panel-title">

	              	<a role="button" data-toggle="collapse" data-parent="#accordionContactServices" href="#collapseContactServices" aria-expanded="true" aria-controls="collapseContactServices">
	                 <span class="pull-right see-filters font12 HelveticaBd margintop2 text-white"> Servicios Contratados </span>
	              	</a>
	            </span>
	           
		    </div>

		    <div id="collapseContactServices" class="collapse in show" aria-labelledby="headingOne" data-parent="#accordionContactServices">

		    	 <div class="card-body">
				   	<div class="row">
				        <div class="col-12"> 

						    <div class="card-header bg-transparent clearfix"> 
						    	<div class="card-header-actions">
							    	<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalNewContactService"> <i class="fa fa-plus"></i> Agregar servicio </button>
					        	</div>
					        </div>
					    	@if($contact->contactHasService->count() > 0)
					    		<table class="table table-hover">
							        <thead>
								        <tr>
								            <th> Cus </th>
								            <th> Servicio </th>
								            <th class="d-none d-sm-table-cell"> Valor ($) </th>
								            <th> Acciones </th>
								        </tr>
							        </thead>
							        <tbody>
							        	@foreach($contact->contactHasService as $chs)
								        <tr>
								            <td>{{ $chs->cus }}</td>
								            <td>{{ $chs->service->name }}</td>
								            <td class="d-none d-sm-table-cell">{{ $chs->service->value }}</td>
								            <td>
												<form action="{{ route('contact_has_services.destroy', $chs->id) }}" class="delete_contactService" method="POST" style="display: inline;">
							                      <input type="hidden" name="_method" value="DELETE">
							                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
							                      <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"  title="Eliminar" ><i class="fa fa-trash"></i></button>
							                    </form>

								            </td>
								        </tr>
								        @endforeach
							        </tbody>
							    </table>
						    @else
							    <div class="text-center" >
							        <p class="mb-0 mt-3"><strong>El contacto aún no ha contratado un servicio</strong></p>  
							    </div>
						    @endif
					    </div>
					</div>
				</div>

		    </div>
		</div>
	</div>
</div>


<!-- Modal New Service -->
<div class="modal fade" id="modalNewContactService" tabindex="-1" role="dialog" aria-labelledby="modalNewContactServiceLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNewContactServiceLabel">Nuevo servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!  Form::model(null,['route' => 'contact_has_services.store', 'id' => 'formNewContactService', 'method' => 'GET']) !!}
		   	<div class="row">
		        <div class="col-12"> 
		        	{!! Form::hidden('contact_id', $contact->id,   ['id' => 'contact_id'] ) !!}

		        	<label> Servicio: </label>
			        {!! Form::select('service_id', \App\Models\Services\Service::pluck('name', 'id')->toArray(), null, ['id' => 'service_id', 'class' => 'form-control required', 'placeholder' => 'Seleccione un servicio'] ) !!}
		        </div>
		    </div>
	    {!!  Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="saveNewContactService" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')
	@parent
		<script type="text/javascript">
			$(document).ready(function() {
				$( "#saveNewContactService" ).click(function(event) {
					event.preventDefault(); // avoid to execute the actual submit of the form.

					var params = {
						contact_id: $("#contact_id" ,"#formNewContactService" ).val(),
						service_id: $("#service_id" ,"#formNewContactService" ).val()
					}

					var errors = 0;
					$.each(params, function(temd,value){
						if(value == '' || value == 'undefined'){
							errors ++;
						}
					});

					if (errors){
						swal('Error', 'Debe seleccionar todos los campos para poder continuar.', 'error');
					}else{
						

						swal( {
							text: "Procesando",
							title: "Por favor espere",
						    button: false,
						});


						var form = $("#formNewContactService");
				    	var url = form.attr('action');

						$.ajax({
				           type: "GET",
				           url: url,
				           data: params, // serializes the form's elements.
				           success: function(data)
				           {
				               swal( {
				               		type: "success",
									text: "Guardado exitoso",
									title: "Por favor espere",
								    button: false,
								});
				               location.reload()
				           },
				           error: function(data)
				           {
				              swal('Error', 'Se ha producido un error', 'error');
				           }
				        });
					}
				});


				$( ".delete_contactService" ).submit(function(event) {
					event.preventDefault();
					var form = $(this);
					swal({
	      				title: "Está seguro?",
					    text: "Desea eliminar el servicio contrataco",
					    icon: "warning",
					    buttons: [
					        'No, cancelar!',
					        'Si, Estoy seguro!'
					    ],
					    dangerMode: true,
					}).then(function(isConfirm) {
					      if (isConfirm) {
					       	form.unbind('submit').submit(); // <--- submit form programmatically
					      } 
					})
				});
			});

		</script>

@endsection
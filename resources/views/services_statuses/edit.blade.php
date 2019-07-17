@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row justify-content-md-center">
	      <div class="col-md-9 col-xl-7">
	        <div class="card-header px-0 mt-2 bg-transparent clearfix">
		        <h4 class="float-left pt-2">Editar estado</h4>
		        <div class="card-header-actions mr-1">
		            <button class="btn btn-primary" id="submit-form" >
		            	Guardar 
		        	</button>

		        	<form action="{{ route('services_statuses.destroy', $service_status->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Borrar? Desea eliminar este estado?')) { return true } else {return false };">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn"><i class="far fa-trash-alt"></i> <span class="d-md-down-none ml-1">Eliminar</span></button>
                    </form>
	            </div>

	        </div>
	        <div class="card-body px-0">
	        	<form id="form" action="{{ route('services_statuses.update', $service_status->id) }}" method="POST">
	        		<input type="hidden" name="_method" value="PUT">
	        		@include('services_statuses.partials.form', ['service_status' => $service_status] )
			    </form>
	        </div>

	      </div>
	    </div>
	</div>
@endsection




@section('scripts')
	@parent
		<script type="text/javascript">
			$(document).ready(function() {
				var submiting_form = false;
				$( "#submit-form" ).click(function(event) {
					event.preventDefault();
					if (!submiting_form){
						submiting_form = true;
						$("#form").submit();
					}
				});
			});
		</script>

@endsection

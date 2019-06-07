@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row justify-content-md-center">
	      <div class="col-md-9 col-xl-7">
	        <div class="card-header px-0 mt-2 bg-transparent clearfix">
		        <h4 class="float-left pt-2">Editar Orden de Instalación</h4>
		        <div class="card-header-actions mr-1">
		            <button class="btn btn-primary" id="submit-form" >
		            	Guardar 
		        	</button>
	            </div>
	        </div>
	        <div class="card-body px-0">
	        	<form id="form" action="{{ route('installation_orders.update', $installation_order->id) }}" method="POST">
	        		<input type="hidden" name="_method" value="PUT">
	        		@include('installation_orders.partials.form', ['installation_order' => $installation_order] )
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
				$( "#submit-form" ).click(function(event) {
					event.preventDefault();
				  	$("#form").submit();
				});

				
                
			});
		</script>

@endsection

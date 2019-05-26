@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row justify-content-md-center">
	      <div class="col-md-9 col-xl-7">
	        <div class="card-header px-0 mt-2 bg-transparent clearfix">
		        <h4 class="float-left pt-2">Editar Contacto</h4>
		        <div class="card-header-actions mr-1">
		            <button class="btn btn-primary" id="submit-form" >
		            	Guardar 
		        	</button>
	            </div>
	        </div>
	        <div class="card-body px-0">
	        	<form id="form" action="{{ route('contacts.update', $contact->id) }}" method="POST">
	        		<input type="hidden" name="_method" value="PUT">
	        		@include('contacts.partials.form', ['contact' => $contact] )
			    </form>
	        </div>

	        @include('contacts.partials.contact_services', ['contact' => $contact] )

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

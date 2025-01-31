@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row justify-content-md-center">
	      <div class="col-10">
	        <div class="card-header px-0 mt-2 bg-transparent clearfix">
		        <h4 class="float-left pt-2">Editar Cliente</h4>
		        <div class="card-header-actions mr-1">
		            <button class="btn btn-primary" id="submit-form" >
		            	Guardar 
		        	</button>
	            </div>
	        </div>
	        <div class="card-body px-0">
	        	<form id="form" action="{{ route('contacts.update', $contact->id) }}" method="POST">
	        		<input type="hidden" name="_method" value="PUT">
	        		@include('contacts.partials.form', ['contact' => $contact, 'referred_by' => $referred_by] )
			    </form>
	        </div>
	        @include( 'contacts.partials.contact_services', ['contact' => $contact] )
	        @include( 'contacts.partials.referrals', ['contact' => $contact] )
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


<div class="card-body px-0">
	<div id="accordionContactServices">
		<div class="card">
		    <div class="card-header bg-success" id="headingOne">
		      	<span class="panel-title">

	              	<a role="button" data-toggle="collapse" data-parent="#accordionContactServices" href="#collapseContactServices" aria-expanded="true" aria-controls="collapseContactServices">
	                 <span class="pull-right see-filters font12 HelveticaBd margintop2 text-white"> Listado de referidos </span>
	              	</a>
	            </span>
	           
		    </div>

		    <div id="collapseContactServices" class="collapse in show" aria-labelledby="headingOne" data-parent="#accordionContactServices">

		    	 <div class="card-body">
				   	<div class="row">
				        <div class="col-12"> 

					    	@if(count($contact->getReferrals()) > 0)
					    		<table class="table table-hover">
							        <thead>
								        <tr>
								            <th> Nombre </th>
								            <th> Cédula de ciudadanía </th>
								            <th class="d-none d-sm-table-cell"> Email </th>
								        </tr>
							        </thead>
							        <tbody>
							        	@foreach($contact->getReferrals() as $referral)
								        <tr>
								            <td>{{ $referral->first_name }} {{ $referral->last_name }}</td>
								            <td>{{ $referral->dni }}</td>
								            <td class="d-none d-sm-table-cell">{{ $referral->email }}</td>
	
								        </tr>
								        @endforeach
							        </tbody>
							    </table>
						    @else
							    <div class="text-center" >
							        <p class="mb-0 mt-3"><strong>Este cliente aún no tiene referidos</strong></p>  
							    </div>
						    @endif
					    </div>
					</div>
				</div>

		    </div>
		</div>
	</div>
</div>
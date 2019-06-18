
<div class="row ">
	<div class="col-12">
		<div class="card-header px-0 bg-transparent">
			<strong>Historial de cambios</strong><br> 
			<small class="text-muted">Vea el hitorial de cambios que ha sufrido la orden de instalación</small> 

			<div class="card-header-actions">
				<div class="float-left mr-2 d-sm-down-none"><small class="text-muted">{{ $installation_order->getHistory->count() }} cambios</small> 
					
				</div> 
				<a href="#" data-toggle="collapse" data-target="#collapseHistory" aria-expanded="true" class="card-header-action btn-minimize"><i class="icon-arrow-down"></i></a>
			</div>
		</div>


		<div id="collapseHistory" class=" collapse">
			<div class="accordion" id="accordionExample">
				@foreach($installation_order->getHistory as $k => $history)
					<div class="card" style="margin-bottom: 0px">
					    <div class="card-header " id="heading{{$history->id}}">
					      	<h2 class="mb-0">
					        	<button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse{{$history->id}}" aria-expanded="true" aria-controls="collapse{{$history->id}}">
					          	<b>{{ $history->created_at }} -  {{ $history->status }}</b>
					        	</button>
					      	</h2>
					    </div>
					    <div id="collapse{{$history->id}}" class="collapse {{ ($k==0) ? 'show': ''}} " aria-labelledby="heading{{$history->id}}" data-parent="#accordionExample">
					      	<div class="card-body">
					      		
			  					<b>Fecha:</b> {{  $history->created_at }}
			  					<br>
			  					<b>Estado:</b> {{  $history->status }}
			  					<br>
			  					<b>Usuario:</b> {{  $history->user->name }}

			      				<hr>
			      				{!! $history->description !!}
			      					@foreach($history->getFiles() as $file)
			      						<a href="{{ $file['url']}}" target="_blank"> <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $file['name'] }} </a>
			      						<br>
			      					@endforeach
					      			
					      	</div>
					    </div>
					</div>
				@endforeach
			  
			</div>
		</div>
	</div>
</div>
<br> <br>
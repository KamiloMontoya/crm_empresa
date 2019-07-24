@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="card-header px-0 mt-2 bg-transparent clearfix">
		    <h4 class="float-left pt-2">Servicios contratados</h4>
	    </div>


	    <div class="card-body px-0">	
	    <!-- SECCION DE ALERTAS -->	
	    	<div class="row ">
		        <div class="col-12">
			        @if(Session::get("message"))
				        <div class="alert alert-success" role="alert">
				      		{{ Session::get("message") }}
				      		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
				      	</div>
			        @endif
			        @if(Session::get("error"))
			         	<div class="alert alert-success" role="alert">
				      		{{ Session::get("error") }}
				      		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							</button>
				      	</div>
			        @endif       
		        </div>
		    </div> 

	    <!-- SECCION DE FILTROS -->
			<div id="accordion">
				<div class="card">
				    <div class="card-header" id="headingOne">
				      	<span class="panel-title">
			              	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			                 <span class="pull-right see-filters font12 HelveticaBd margintop2">Ver Filtros</span>
			              	</a>
			            </span>
			           
				    </div>

				    <div id="collapseOne" class="collapse in show" aria-labelledby="headingOne" data-parent="#accordion">
				    	{!!  Form::model($request,['route' => 'contact_has_services.index', 'method' => 'GET']) !!}
				        <div class="card-body">
						   	<div class="row justify-content-between">
						        <div class="col-12 col-sm-6 col-md-6 col-lg-6"> 
							        {!!  Form::text('cus', null, ['class' => 'form-control', 'placeholder' => 'CUS']) !!}
						        </div>
						       	
						    </div>
				        </div>

				        <div class="card-footer text-muted">
					    	<button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                			<a href="{{ route('contact_has_services.index') }}" class="btn btn-sm btn-secondary">Restablecer</a>
					    </div>
					    {!!  Form::close() !!}
				    </div>
				</div>
			</div>

		<!-- SECCION DE LISTADO -->
			<table class="table table-hover">
		        <thead>
			        <tr>
			            <th > CUS </th>
			            <th class="d-none d-sm-table-cell"> Contacto </th>
			            <th class="d-none d-sm-table-cell"> Emails </th>
			            <th > Servicio</th>
			            <th > Acciones </th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($contact_has_services as $chs)
			        <tr>
			            <td >{{ $chs->cus }}</td>
			            <td class="d-none d-sm-table-cell">{{ $chs->contact->first_name.' '.$chs->contact->last_name }}</td>
			            <td class="d-none d-sm-table-cell">{{ $chs->contact->email }}</td>
			            <td >{{ $chs->service->name }}</td>

			            
			            <td >
			              <a href="{{ route('contact_has_services.edit', $chs->id) }}" class="text-muted" data-toggle="tooltip" title="Editar"><i class="fas fa-pencil-alt"></i></a>

			               <a href="{{ route('contact_has_services.edit', $chs->id) }}" class="" data-toggle="tooltip" title="Generar factura"><i class="fas fa-file"></i></a>
			              
			            </td>
			        </tr>
			        @endforeach
		        </tbody>
		    </table>

		    @if($contact_has_services->count() == 0)
		    <div class="no-items-found text-center mt-5" >
		        <i class="icon-magnifier fa-3x text-muted"></i>
		        <p class="mb-0 mt-3"><strong>No se encontraron resultados para la busqueda</strong></p>
		        
		    </div>
		    @endif

		    {!! $contact_has_services->appends($request)->render() !!}

    	</div>
	</div>
@endsection
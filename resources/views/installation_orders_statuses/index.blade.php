@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="card-header px-0 mt-2 bg-transparent clearfix">
		    <h4 class="float-left pt-2">Estados de ordenes de instalación</h4>
		    <div class="card-header-actions mr-1">
		        <a class="btn btn-success" href="{{ route('installation_orders_statuses.create') }}">Nuevo estado</a>
		    </div>
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

	    

		<!-- SECCION DE LISTADO -->
			<table class="table table-hover">
		        <thead>
			        <tr>
			            <th class="d-none d-sm-table-cell"> ID </th>
			            <th > Nombre corto</th>
			            <th class="d-none d-sm-table-cell"> Nombre </th>
			            <th class="d-none d-sm-table-cell"> Estado por defecto ? </th>
			            <th >  </th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($installation_orders_statuses as $installation_orders_status)
			        <tr>
			            <td class="d-none d-sm-table-cell">{{ $installation_orders_status->id }}</td>
			            <td >{{ $installation_orders_status->name }}</td>
			            <td class="d-none d-sm-table-cell">{{ $installation_orders_status->long_name }}</td>
			            <td class="d-none d-sm-table-cell">{{ $installation_orders_status->is_default ? 'SI' : 'NO' }}</td>
			            
			            <td >
			              <a href="{{ route('installation_orders_statuses.edit', $installation_orders_status->id) }}" class="text-muted"><i class="fas fa-pencil-alt"></i></a>
			            </td>
			        </tr>
			        @endforeach
		        </tbody>
		    </table>

		    @if($installation_orders_statuses->count() == 0)
		    <div class="no-items-found text-center mt-5" >
		        <i class="icon-magnifier fa-3x text-muted"></i>
		        <p class="mb-0 mt-3"><strong>No se encontraron resultados para la busqueda</strong></p>
		        
		    </div>
		    @endif

		    {!! $installation_orders_statuses->appends($request)->render() !!}

    	</div>
	</div>
@endsection
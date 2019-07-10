@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="card-header px-0 mt-2 bg-transparent clearfix">
		    <h4 class="float-left pt-2">Promociones en servicios (descuentos)</h4>
		    <div class="card-header-actions mr-1">
		        <a class="btn btn-success" href="{{ route('promotions.create') }}">Nueva promoción</a>
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

		 <!-- SECCION DE FILTROS -->
			<div id="accordion">
				<div class="card">
				    <div class="card-header" id="headingOne">
				      	<span class="panel-title">
			              	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			                 <span class="pull-right see-filters font12 HelveticaBd margintop2">Ver Filtros <i class="fa fa-arrow-down"></i></span>
			              	</a>
			            </span>
			           
				    </div>

				    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
				    	{!!  Form::model($request,['route' => 'promotions.index', 'method' => 'GET']) !!}
				        <div class="card-body">
						   	<div class="row justify-content-between">
						        <div class="col-12"> 
							        {!!  Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
						        </div>
						       	
						    </div>
				        </div>

				        <div class="card-footer text-muted">
					    	<button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                			<a href="{{ route('promotions.index') }}" class="btn btn-sm btn-secondary">Restablecer</a>
					    </div>
					    {!!  Form::close() !!}
				    </div>
				</div>
			</div>

	    

		<!-- SECCION DE LISTADO -->
			<table class="table table-hover">
		        <thead>
			        <tr>
			            <th class="d-none d-sm-table-cell"> ID </th>
			            <th > Nombre</th>
			            <th class="d-none d-sm-table-cell"> Porcentaje de descuento </th>
			            <th class="d-none d-sm-table-cell"> Activo ? </th>
			            <th >  </th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($promotions as $promotion)
			        <tr>
			            <td class="d-none d-sm-table-cell">{{ $promotion->id }}</td>
			            <td >{{ $promotion->name }}</td>
			            <td class="d-none d-sm-table-cell">{{ $promotion->discount }} %</td>
			            <td class="d-none d-sm-table-cell">{{ $promotion->active ? 'SI' : 'NO' }}</td>
			            
			            <td >
			              <a href="{{ route('promotions.edit', $promotion->id) }}" class="text-muted"><i class="fas fa-pencil-alt"></i></a>
			            </td>
			        </tr>
			        @endforeach
		        </tbody>
		    </table>

		    @if($promotions->count() == 0)
		    <div class="no-items-found text-center mt-5" >
		        <i class="icon-magnifier fa-3x text-muted"></i>
		        <p class="mb-0 mt-3"><strong>No se encontraron resultados para la busqueda</strong></p>
		        
		    </div>
		    @endif

		    {!! $promotions->appends($request)->render() !!}

    	</div>
	</div>
@endsection
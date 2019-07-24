<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="contact_has_service_id" value="{{ $chs->id }}">

<div class="row" style="border: gray; border-style: dashed;" >
	<div class="col-12 col-sm-5 col-md-5 col-lg-5"  >
		<br>
        @if($chs->contact)
            <div class="form-group">
                <span><b> CUS: </b> {{ $chs->cus }}</span>
                <br>
                <span><b> Cliente: </b> {{ $chs->contact->first_name }} {{ $chs->contact->duty }}</span>
                <br>
                <span><b> Dirección: </b> {{ $chs->contact->address }}</span>
                <br>
                <span><b> Ciudad: </b> {{ $chs->contact->city }} </span>
                <br>
                <span><b> Telefono: </b> {{ $chs->contact->phone }} </span>
                <br>
                <span><b> Celular: </b> {{ $chs->contact->celphone }}</span>
                <br>
                <span><b> Email: </b> {{ $chs->contact->email }}</span>
            </div>
        @endif
    </div>

    <div class="col-12 col-sm-7 col-md-7 col-lg-7">
        <br>
        <div class="form-group row">
            <label class="col-sm-4">Impuestos (%)</label>
            <div class="col-sm-8">
                <input type="number" class="form-control only-numbers @if($errors->has('duty')) is-invalid @endif" name="duty" value="{{ isset($invoice) ? $invoice->duty :  old('duty') }}" placeholder="0">
                @if($errors->has("duty"))
                    <div class="invalid-feedback" style="display:block">{{ $errors->first("duty") }}</div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4">Descuento ($)</label>
            <div class="col-sm-8">
                <input type="number" class="form-control only-numbers @if($errors->has('discount')) is-invalid @endif" name="discount" value="{{ isset($invoice) ? $invoice->discount :  old('discount') }}" placeholder="0">
                @if($errors->has("discount"))
                    <div class="invalid-feedback" style="display:block">{{ $errors->first("discount") }}</div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4">Fecha de pago </label>
            <div class="col-sm-8">
                <input type="text" id="payment_date" class="form-control datepicker @if($errors->has('payment_date')) is-invalid @endif" name="payment_date" value="{{ isset($invoice) ? $invoice->payment_date :  old('payment_date') }}" placeholder="AAAA-MM-DD">
                @if($errors->has("payment_date"))
                    <div class="invalid-feedback" style="display:block">{{ $errors->first("payment_date") }}</div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4">Fecha de vencimiento </label>
            <div class="col-sm-8">
                <input type="text" id="expiration_date" class="form-control datepicker @if($errors->has('expiration_date')) is-invalid @endif" name="expiration_date" value="{{ isset($invoice) ? $invoice->expiration_date :  old('expiration_date') }}" placeholder="AAAA-MM-DD">
                @if($errors->has("expiration_date"))
                    <div class="invalid-feedback" style="display:block">{{ $errors->first("expiration_date") }}</div>
                @endif
            </div>
        </div>

    </div>


    <div class="col-12" >
        <hr style="border: gray; border-top: dashed;" >
        <h5> <b>Detalles de la compra</b> </h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> Cantidad </th>
                    <th> Descripción </th>
                    <th> Valor ($) </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 1 </td>
                    <td> 
                        <textarea type="text" rows="3" cols="50" class="form-control @if($errors->has('description')) is-invalid @endif" name="description" value="{{  old('description') }}" placeholder=""> </textarea>

                        @if($errors->has("description"))
                            <div class="invalid-feedback" style="display:block">{{ $errors->first("description") }}</div>
                        @endif
                    </td>
                    <td>
                            <input type="text" class="form-control @if($errors->has('subtotal')) is-invalid @endif" readonly="true" name="subtotal" value="{{ isset($chs) ? $chs->service->value :  old('subtotal') }}" placeholder="0">
                            @if($errors->has("subtotal"))
                                <div class="invalid-feedback" style="display:block">{{ $errors->first("subtotal") }}</div>
                            @endif
                    </td>
                </tr>

                <tr>
                    <td class="text-right" colspan="2"> Subtotal ($)</td>
                    <td class="text-right"> 
                        <input type="text" class="form-control" readonly="true"  value="{{ isset($chs) ? $chs->service->value :  old('subtotal') }}" placeholder="0">

                    </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="2"> Impuestos ($)</td>
                    <td class="text-right"> 
                        <input type="text" class="form-control" readonly="true"  value="0" placeholder="0">

                    </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="2"> Descuento ($)</td>
                    <td class="text-right"> 
                        <input type="text" class="form-control" readonly="true"  value="0" placeholder="0">
                    </td>
                </tr>
                <tr>
                    <td class="text-right" colspan="2"> Total ($)</td>
                    <td class="text-right"> 
                        <input type="text" class="form-control" readonly="true"  value="{{ isset($chs) ? $chs->service->value :  old('subtotal') }}" placeholder="0">
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>
<hr>


@section('scripts')

    @parent
        <script>

            $('#payment_date').datepicker({
                uiLibrary: 'bootstrap4'
            });

            $('#expiration_date').datepicker({
                uiLibrary: 'bootstrap4'
            });

        </script>
@endsection



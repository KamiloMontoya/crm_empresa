<?php

namespace App\Http\Controllers\InstallationOrders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Response;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Upload;
use App\Models\InstallationOrders\InstallationOrder;
use App\Models\InstallationOrders\InstallationOrderStatus;
use App\Models\InstallationOrders\HistoryInstallationOrder;
use App\Models\ContactHasServices\ContactHasService;

use Illuminate\Support\Facades\Validator;



class InstallationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $installation_orders = InstallationOrder::
                select('installation_orders.*')
                ->join('contact_has_services', 'contact_has_services.id', '=', 'installation_orders.contact_has_service_id')
                ->orderBy('installation_orders.id', 'ASC');

        if($request->cus) {
            $installation_orders->where('contact_has_services.cus', 'LIKE', '%'.$request->cus.'%');
        }


        
        return view('installation_orders.index', ['installation_orders' => $installation_orders->paginate(10), 'request' => $request->all()] );
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   

        try { 
            $valid = $this->validatorCreate($request->all());

            $response = array();
            
            if($valid->fails()){

                $response['code']     =   500;
                $response['status']   =   "error";
                $response['message']  =   $valid->errors();   
                return Response::json($response, $response['code']);  

            }else{

                $chs =  ContactHasService::where('cus', '=', $request->input("cus"))->first();

                if (!$chs){
                    $response['code']     =   500;
                    $response['status']   =   "error";
                    $response['message']  =  "Servicio no encontrado"; 
                    return Response::json($response, $response['code']); 
                }
                $installation_orders = InstallationOrder::where('contact_has_service_id', '=', $chs->id)->first();

                if ($installation_orders){
                    $response['code']     =   500;
                    $response['status']   =   "error";
                    $response['message']  =  "Ya existe una orden de instalación para este CUS"; 
                    return Response::json($response, $response['code']); 
                }  


                $installation_orders = new InstallationOrder();
                $installation_orders->contact_has_service_id = $chs->id; 
                $status = InstallationOrderStatus::where('is_default', '=', true)->first();
                if ($status){
                    $installation_orders->status = $status->name ; 
                }
                
                $installation_orders->save();

                $response['code']     = 200;
                $response['status']   = "status";
                $response['message']  = "Guardado Exitoso";    

            }
            return Response::json($response, $response['code']); 

        }catch (BadRequest $e) {
            $response['code']     =   400;
            $response['status']   =   "error";
            $response['message']  =  "Invalid data";       
            return Response::json($response, $response['code']); 
        } catch (Exception $e) {   

            $response['code']     =     500;
            $response['status']   =   "error";
            $response['message']  =  "Failed request ".$e->getMessage();    
            return Response::json($response, $response['code']); 
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $installation_order = InstallationOrder::findOrFail($id);

        return view('installation_orders.edit', ['installation_order' => $installation_order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $valid = $this->validator($request->all());

        if($valid->fails()){
            return redirect()->back()
                    ->withErrors($valid->errors())
                    ->withInput();
        }else{
            $installation_order = InstallationOrder::findOrFail($id);
            
            if ($installation_order ){

                /*========================================================
                =            Creando registro en el historial            =
                ========================================================*/
                
                    $log = new HistoryInstallationOrder();
                    $log->status = $request->input("status");
                    $log->description = $request->input("comment");
                    $log->user_id = Auth::id();
                    $log->installation_order_id = $installation_order->id;
                    $log->save();
                
                /*=====  End of Creando registro en el historial  ======*/
                
                /*============================================
                =            Almacenando archivos            =
                ============================================*/
                
                    if ($request->file_one){
                        $name = $request->file('file_one')->getClientOriginalName();
                        $upload = new Upload();
                        $file = $upload->uploadAs($request->file_one, 'public/installation_orders/'.$installation_order->id.'/'.$log->id, $name )->getData();
                    }

                    if ($request->file_two){
                        $name = $request->file('file_two')->getClientOriginalName();
                        $upload = new Upload();
                        $file = $upload->uploadAs($request->file_two, 'public/installation_orders/'.$installation_order->id.'/'.$log->id, $name )->getData();
                    }
                
                /*=====  End of Almacenando archivos  ======*/
                
                

                $installation_order->status = $request->input("status"); 
                $installation_order->save();
            }


            
            

        }

        return redirect()->route('installation_orders.index')->with('message', 'Orden actualizada correctamente.');
    }


    protected function validator(array $data)
    {   
        $rules = [
            'status' => 'required|string'
        ];

        return Validator::make($data, $rules);
    }

    protected function validatorCreate(array $data)
    {   
        $rules = [
            'cus' => 'required|string',
        ];

        return Validator::make($data, $rules);
    }
}

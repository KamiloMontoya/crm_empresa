<?php

namespace App\Http\Controllers\ContactHasServices;

use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;
use App\Models\ContactHasServices\ContactHasService;
use App\Models\Services\Service;
use App\Models\Contacts\Contact;

use Illuminate\Support\Facades\Validator;


class ContactHasServiceController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       
        $contact_has_services = ContactHasService::
        select('contact_has_services.*')
        ->join('services', 'contact_has_services.service_id', '=', 'services.id')
        ->join('contacts', 'contact_has_services.contact_id', '=', 'contacts.id')
        ->orderBy('id', 'ASC');

        if ($request->input("cus")){
            $contact_has_services->where('contact_has_services.cus', "LIKE", '%'.$request->input("cus").'%');
        }

        return view('contact_has_services.index', ['contact_has_services' => $contact_has_services->paginate(10), 'request' => $request->all()] );
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
            $valid = $this->validator($request->all());

            $response = array();
            
            if($valid->fails()){

                $response['code']     =   500;
                $response['status']   =   "error";
                $response['message']  =   $valid->errors();   
                return Response::json($response, $response['code']);  

            }else{

                $service =  Service::findOrFail($request->input("service_id"));
                $contact =  Contact::findOrFail($request->input("contact_id"));

                if (!$service || !$contact){
                    $response['code']     =   500;
                    $response['status']   =   "error";
                    $response['message']  =  "Servicio no encontrado"; 
                    return Response::json($response, $response['code']); 
                }
                

                $contact_has_service = new ContactHasService();
                $contact_has_service->service_id = $service->id; 
                $contact_has_service->contact_id = $contact->id; 
                $contact_has_service->cus = '-'; 
                $contact_has_service->save();

                if ($contact_has_service){
                    $contact_has_service->cus = (!is_null($service->prefix) && $service->prefix != '' ) ? $service->prefix.'_'.$contact_has_service->id : $contact_has_service->id; 
                    $contact_has_service->save();
                }


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


    public function destroy ($id)
    {
        ContactHasService::destroy($id);
        return redirect()->back();
    }


    protected function validator(array $data)
    {   
        $rules = [
            'contact_id' => 'required|integer',
            'service_id' => 'required|integer'
        ];

        return Validator::make($data, $rules);
    }
}

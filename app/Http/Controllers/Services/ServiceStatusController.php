<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Response;
use App\Http\Controllers\Controller;
use App\Models\Services\ServiceStatus;

use Illuminate\Support\Facades\Validator;



class ServiceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $services_statuses = ServiceStatus::orderBy('id', 'ASC');

        return view('services_statuses.index', ['services_statuses' => $services_statuses->paginate(10), 'request' => $request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
        $valid = $this->validator($request->all());
        if($valid->fails()){
            return redirect()->back()
                    ->withErrors($valid->errors())
                    ->withInput();
        }else{
            $service_status = new ServiceStatus;
            $service_status->name = $request->input("name");
            $service_status->long_name = $request->input("long_name");
            $service_status->is_default = $request->input("is_default", 0); 
            $service_status->save();
        }

        return redirect()->route('services_statuses.index')->with('message', 'Estado creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $service_status = ServiceStatus::findOrFail($id);

        return view('services_statuses.edit', ['service_status' => $service_status]);
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
            $service_status = ServiceStatus::findOrFail($id);
            
            if ($service_status ){
                $service_status->name = $request->input("name");
                $service_status->long_name = $request->input("long_name");
                $service_status->is_default = $request->input("is_default", 0); 
                $service_status->save();
            }   

        }
        return redirect()->route('services_statuses.index')->with('message', 'Estado actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $service_status = ServiceStatus::findOrFail($id);
        
        $service_status->delete();
        return redirect()->route('services_statuses.index')->with('message', 'Estado eliminado.');
        
    }

    protected function validator(array $data)
    {   
        $rules = [
            'name' => 'required|string',
            'long_name' => 'required|string'
        ];

        return Validator::make($data, $rules);
    }
}

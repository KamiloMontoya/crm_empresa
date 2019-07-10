<?php

namespace App\Http\Controllers\InstallationOrders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Response;
use App\Http\Controllers\Controller;
use App\Models\InstallationOrders\InstallationOrderStatus;

use Illuminate\Support\Facades\Validator;



class InstallationOrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $installation_orders_statuses = InstallationOrderStatus::orderBy('id', 'ASC');

        return view('installation_orders_statuses.index', ['installation_orders_statuses' => $installation_orders_statuses->paginate(10), 'request' => $request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('installation_orders_statuses.create');
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
            $installation_orders_status = new InstallationOrderStatus;
            $installation_orders_status->name = $request->input("name");
            $installation_orders_status->long_name = $request->input("long_name");
            $installation_orders_status->is_default = $request->input("is_default", 0); 
            $installation_orders_status->save();
        }

        return redirect()->route('installation_orders_statuses.index')->with('message', 'Estado creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $installation_orders_status = InstallationOrderStatus::findOrFail($id);

        return view('installation_orders_statuses.edit', ['installation_orders_status' => $installation_orders_status]);
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
            $installation_orders_status = InstallationOrderStatus::findOrFail($id);
            
            if ($installation_orders_status ){
                $installation_orders_status->name = $request->input("name");
                $installation_orders_status->long_name = $request->input("long_name");
                $installation_orders_status->is_default = $request->input("is_default", 0); 
                $installation_orders_status->save();
            }   

        }
        return redirect()->route('installation_orders_statuses.index')->with('message', 'Estado actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $installation_orders_status = InstallationOrderStatus::findOrFail($id);
        
        $installation_orders_status->delete();
        return redirect()->route('installation_orders_statuses.index')->with('message', 'Estado eliminado.');
        
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

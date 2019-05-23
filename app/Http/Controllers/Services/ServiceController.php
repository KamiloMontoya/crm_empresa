<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Services\Service;

class ServiceController extends Controller
{
	public function filter (Request $request)
    {
        $query = Service::query();

        if($request->search) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $services = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                    ->paginate($request->input('pagination.per_page'));


        return $services;
    }

    public function all()
    {
        return Service::all();
    }

    public function show ($service)
    {
        return Service::findOrFail($service);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'value' => 'required|string'
        ]);

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value
        ]);

       

        return $service;
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'value' => 'required|string'
        ]);

        $service = Service::find($request->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->value = $request->value;

        $service->save();
    }

    public function destroy ($service)
    {
        return Service::destroy($service);
    }

    public function count ()
    {
        return Service::count();
    }

    public function getServiceData ($service)
    {
        $service = Service::find($service);
        return $service;
    }

}

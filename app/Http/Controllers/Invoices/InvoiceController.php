<?php

namespace App\Http\Controllers\Invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use App\Models\ContactHasServices\ContactHasService;


class InvoiceController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       dd('Index') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($contact_has_service_id = null)
    {   
        $chs = ContactHasService::findOrFail($contact_has_service_id);
        
        return view('invoices.create', ['chs' => $chs]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
        dd('Store') ;
    }

    // protected function validator(array $data, $id = null)
    // {   
    //     $rules = [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required|email|unique:contacts,email',
    //         'dni' => 'required|integer|unique:contacts,dni',
    //         'celphone' => 'required'
    //     ];

    //     if ( $id ){
    //         $rules['email'] = $rules['email'] .','. $id. ',id' ;
    //         $rules['dni'] = $rules['dni'] .','. $id. ',id' ;
    //     }


    //     return Validator::make($data, $rules);
    // }
}

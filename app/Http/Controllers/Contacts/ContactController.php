<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contacts\Contact;

class ContactController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        

        $contacts = Contact::orderBy('id', 'ASC');

        if ($request->input("first_name")){
            $contacts->where('first_name', "LIKE", '%'.$request->input("first_name").'%');
        }

        if ($request->input("last_name")){
            $contacts->where('last_name', "LIKE", '%'.$request->input("last_name").'%');
        }

        return view('backend.contacts.index', ['contacts' => $contacts->paginate(10), 'request' => $request->all()] );
    }

}

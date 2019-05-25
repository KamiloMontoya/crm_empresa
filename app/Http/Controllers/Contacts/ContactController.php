<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contacts\Contact;

use Illuminate\Support\Facades\Validator;


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

        return view('contacts.index', ['contacts' => $contacts->paginate(10), 'request' => $request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $contacts = \DB::table('contacts')->get();
        return view('contacts.create', ['contacts' => $contacts]);
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
            $contact = new Contact();
            $contact->first_name = $request->input("first_name");
            $contact->last_name = $request->input("last_name");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->celphone = $request->input("celphone");
            $contact->address = $request->input("address");
            $contact->city = $request->input("city");
            $contact->save();
        }

        return redirect()->route('contacts.index')->with('message', 'Contacto creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.edit', ['contact' => $contact]);
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
            $contact = Contact::findOrFail($id);
            $contact->first_name = $request->input("first_name");
            $contact->last_name = $request->input("last_name");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->celphone = $request->input("celphone");
            $contact->address = $request->input("address");
            $contact->city = $request->input("city");
            $contact->save();
        }

        return redirect()->route('contacts.index')->with('message', 'Contacto actualizado correctamente.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'celphone' => 'required'
        ]);
    }
}

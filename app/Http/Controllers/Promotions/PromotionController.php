<?php

namespace App\Http\Controllers\Promotions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Response;
use App\Http\Controllers\Controller;
use App\Models\Promotions\Promotion;

use Illuminate\Support\Facades\Validator;



class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $promotions = Promotion::orderBy('id', 'ASC');

        if ($request->input("name")){
            $promotions->where('name', "LIKE", '%'.$request->input("name").'%');
        }

        return view('promotions.index', ['promotions' => $promotions->paginate(10), 'request' => $request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('promotions.create');
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
            $promotion = new Promotion;
            $promotion->name = $request->input("name");
            $promotion->description = $request->input("description");
            $promotion->active = $request->input("active", 0); 
            $promotion->discount = $request->input("discount");
            $promotion->discount_period = $request->input("discount_period");
            $promotion->save();
        }

        return redirect()->route('promotions.index')->with('message', 'Promoción creada exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);

        return view('promotions.edit', ['promotion' => $promotion]);
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
            $promotion = Promotion::findOrFail($id);
            
            if ($promotion ){
                $promotion->name = $request->input("name");
                $promotion->name = $request->input("name");
                $promotion->description = $request->input("description");
                $promotion->active = $request->input("active", 0); 
                $promotion->discount = $request->input("discount");
                $promotion->discount_period = $request->input("discount_period");
                $promotion->save();
            }   

        }
        return redirect()->route('promotions.index')->with('message', 'Promoción actualizada exitosamente');
    }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function destroy($id)
    // {
    //     $promotion = Promotion::findOrFail($id);
        
    //     $promotion->delete();
    //     return redirect()->route('promotions.index')->with('message', 'Promoción eliminada.');
        
    // }

    protected function validator(array $data)
    {   
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
            'discount' => 'required|numeric|min:0|max:100',
            'discount_period' => 'required|numeric|min:0'
        ];

        return Validator::make($data, $rules);
    }
}

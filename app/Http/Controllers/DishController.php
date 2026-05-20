<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes=Dish::where('user_id',auth()->user()->id)->get();
        return response()->json(['dishes' =>$dishes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
        ],[
            'name.required' => 'Le champ name est requis.',
            'description.required' => 'Le champ description est requis.',

        ]);

        $dish = Dish::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'user_id'=>auth()->user()->id
        ]);

        return response()->json(['dish' =>$dish]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        //dis en question
        $dish=Dish::findOrFail($id);
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
        ],[
            'name.required' => 'Le champ name est requis.',
            'description.required' => 'Le champ description est requis.',

        ]);

        $dish = $dish->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return response()->json(['dish' =>$dish]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

    }

    public function delete( $id)
    {
        $dish=Dish::findOrFail($id);

        //remove event

        if($dish->user_id!=auth()->user()->id){
        return redirect()->back()->with('error', 'Event not found');
        }
        $dish->delete();

        return response()->json(['dish' =>$dish]);
    }
}

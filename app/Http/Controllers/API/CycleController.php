<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cycles = Cycle::all();

        return response()->json(['cycles' => $cycles], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // Add your validation rules for storing a cycle
        ]);

        $cycle = Cycle::create($request->all());

        return response()->json(['cycle' => $cycle], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function show(Cycle $cycle)
    {
        return response()->json(['cycle' => $cycle], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cycle $cycle)
    {
        $request->validate([
            // Add your validation rules for updating a cycle
        ]);

        $cycle->update($request->all());

        return response()->json(['cycle' => $cycle], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cycle $cycle)
    {
        $cycle->delete();

        return response()->json(['message' => 'Cycle deleted successfully'], 200);
    }
}

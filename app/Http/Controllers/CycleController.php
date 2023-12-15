<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cycle;


class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all cycles from the database
        $cycles = Cycle::all();
        
        // Return the view with the cycles data
        return view('cycles.index', compact('cycles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cycles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:cycles|max:255',
            'code' => 'required|digits:4|unique:cycles',
        ]);

        $cycle = new Cycle();
        $cycle->name = $request->input('name');
        $cycle->code = $request->input('code');
        $cycle->save();

        // Redirect to the cycles index page or do something else
        return redirect()->route('cycles.index')->with('success', 'Cycle created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function show(Cycle $cycle) {
        return view('cycles.show', compact('cycle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function edit(Cycle $cycle) {
        return view('cycles.edit', compact('cycle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cycle $cycle) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
        ]);
    
        // Check if the updated name is unique, excluding the current cycle's ID
        $isUniqueName = Cycle::where('name', $request->input('name'))
            ->where('id', '!=', $cycle->id)
            ->doesntExist();
    
        // Check if the updated code is unique, excluding the current cycle's ID
        $isUniqueCode = Cycle::where('code', $request->input('code'))
            ->where('id', '!=', $cycle->id)
            ->doesntExist();
    
        // If either the name or the code is not unique, redirect back with an error message
        if (!$isUniqueName || !$isUniqueCode) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'The name or code already exists. Please choose a unique value.']);
        }
    
        // Update the cycle with the validated data
        $cycle->name = $request->input('name');
        $cycle->code = $request->input('code');
        $cycle->updated_at = now();
        $cycle->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('cycles.index')
            ->with('success', 'Cycle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cycle $cycle) {
        $cycle->delete();

        // Redirect to the index page with a success message
        return redirect()->route('cycles.index')
            ->with('success', 'Cycle deleted successfully.');
    }
}

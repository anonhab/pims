<?php

namespace App\Http\Controllers;

use App\Models\Prison;
use Illuminate\Http\Request;

class PrisonController extends Controller
{
    // Display a listing of the resource (index).
    public function index()
    {
        $prisons = Prison::all();  // Fetch all prisons from the database
        return view('view_prison', compact('prisons'));  // Return view with the list of prisons
    }

    // Show the form for creating a new resource (create).
    public function create()
    {
        return view('prisons.create');  // Return the view for creating a new prison
    }

    // Store a newly created resource in storage (store).
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);
    
        // Store the new prison
        Prison::create($validated);
    
        // Redirect with a success message
        return redirect()->route('prisons.index')->with('success', 'Prison added successfully!');
    }

    // Display the specified resource (show).
    public function show($id)
    {
        $prison = Prison::findOrFail($id);  // Find the prison by ID
        return view('prisons.show', compact('prison'));  // Return the prison details view
    }

    // Show the form for editing the specified resource (edit).
    public function edit($id)
    {
        $prison = Prison::findOrFail($id);  // Find the prison by ID
        return view('prisons.edit', compact('prison'));  // Show the form for editing the prison
    }

    // Update the specified resource in storage (update).
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'managed_by' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);

        // Find the prison by ID
        $prison = Prison::findOrFail($id);
        
        // Update the prison with new data
        $prison->update($request->all());

        // Redirect back to the prisons index page with a success message
        return redirect()->route('prisons.index')->with('success', 'Prison updated successfully!');
    }

    // Remove the specified resource from storage (destroy).
    public function destroy($id)
    {
        // Find the prison by ID and delete it
        Prison::destroy($id);

        // Redirect back to the prisons index page with a success message
        return redirect()->route('prisons.index')->with('success', 'Prison deleted successfully!');
    }
}

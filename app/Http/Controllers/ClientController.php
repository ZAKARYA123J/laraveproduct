<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController  extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $clients = Client::all();
    return view('clients.show', compact('clients'));
}
    public function create()
    {
        return view('clients.insert'); // Assuming you have a create.blade.php view
    }
    
    public function store(Request $request)
    {
        // Validation logic if needed
        $request->validate([
            'name' => 'required',
            'status' => 'in:approve,notify,delete', // Validate the 'status' field
            // Add other validation rules as needed
        ]);

        // Create a new record in the database using the Eloquent model
        client::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            // Add other fields as needed
        ]);

        // Redirect or respond as needed
        return redirect()->route('clients.create')->with('success', 'Record created successfully!');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loginapi; // Adjusted the case here

class LoginController extends Controller
{

    public function index()
    {
        // Fetch all login records
        $logins = Loginapi::all();

        return response()->json($logins, 200);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:loginapis|max:255',
            'password' => 'required|min:10',
        ]);

        // Create new record
        $Loginapi = Loginapi::create($validatedData);

        if ($Loginapi) {
            return response()->json($Loginapi, 201); // Return 201 Created
        } else {
            return response()->json(['message' => 'Could not create login record'], 400); // Return 400 Bad Request
        }
    }


    public function update(Request $request, $id)
    {
        // Find the record
        $Loginapi = Loginapi::findOrFail($id);

        // Validate request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:loginapis,email,' . $Loginapi->id, // Adjusted the case here
            'password' => 'required',
            // Other validation rules for additional columns
        ]);

        // Update the record
        $Loginapi->update($validatedData);

        return response()->json($Loginapi, 200);
    }

    public function destroy($id)
    {
        // Find the record
        $Loginapi = Loginapi::findOrFail($id);

        // Delete the record
        $Loginapi->delete();

        return response()->json(null, 204);
    }
}

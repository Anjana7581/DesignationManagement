<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;

class UserController extends Controller
{
    // List all users in alphabetical order
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        $designations = Designation::all();
        return view('admin.users.index', compact('users', 'designations'));

    }

    // Show the form for creating a new user
    public function create()
    {
        $designations = Designation::all();
        return view('admin.users.create', compact('designations'));
    }

    // Store a newly created user
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
           // Store method in UserController
$validated = $request->validate([
    'name' => 'required|alpha|min:3',  // Validates alphabetic and minimum length of 3
    'email' => 'required|email|unique:users,email',
    'contact_number' => 'nullable|digits:10',
    'alt_contact_number' => 'nullable|digits:10',
    'address' => 'nullable|string',
    'designation_id' => 'required|exists:designations,id',
    'password' => 'required|min:8',
    'status' => 'required|in:0,1',
], [
    'name.alpha' => 'The name must only contain alphabetic characters.',
    'name.min' => 'The name must be at least 3 characters long.',
    // You can add more custom messages here
]);


            // Create the new user record
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->alt_contact_number = $request->alt_contact_number;
            $user->address = $request->address;
            $user->designation_id = $request->designation_id;
            $user->status = $request->status;
            $user->password = Hash::make($request->password); // Hash the password before saving
            $user->save();

            // Return success response as JSON
            return response()->json([
                'success' => true,
                'message' => 'User added successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return them as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle any other errors and return a failure response as JSON
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Show the form for editing a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $designations = Designation::all();
        return view('admin.users.edit', compact('user', 'designations'));
    }

    public function update(Request $request, $id)
{
    // Validate request (similar to store method)
    $validated = $request->validate([
        'name' => 'required|alpha|min:3',
        'email' => 'required|email|unique:users,email,' . $id,
        'contact_number' => 'nullable|digits:10',
        'alt_contact_number' => 'nullable|digits:10',
        'address' => 'required|string',
        'designation_id' => 'required|exists:designations,id',
        'status' => 'required|boolean',
    ]);

    // Find the user to be updated
    $user = User::find($id);

    if ($user) {
        // Update user data with validated input
        $user->update($validated);

        // Return a success response (AJAX response)
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.'
        ]);
    }

    // Return error response if user is not found
    return response()->json([
        'success' => false,
        'message' => 'User not found.'
    ]);
}


// In UserController.php

// In UserController.php

public function filter(Request $request)
{
    // Build the query
    $query = User::query();

    // Alphabetical order (A-Z or Z-A)
    if ($request->has('alphabetic_order') && in_array($request->alphabetic_order, ['asc', 'desc'])) {
        $query->orderBy('name', $request->alphabetic_order);
    }

    // Filter by designation 
    if ($request->has('designation_id') && $request->designation_id != '') {
        $query->where('designation_id', $request->designation_id);
    }

    // Filter by status 
    if ($request->has('status') && $request->status !== '') {
        $query->where('status', $request->status);
    }

    // Get the users after filtering
    $users = $query->get();

    
    return response()->json(['users' => $users]);
}




}
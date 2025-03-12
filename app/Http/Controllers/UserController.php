<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;

class UserController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        $users = User::with('designation')->orderBy('name')->get();
        return view('admin.users.index', compact('users', 'designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact_number' => 'nullable|digits:10',
            'designation_id' => 'required|exists:designations,id',
        ]);

        User::create($request->all());

        return response()->json(['message' => 'User added successfully']);
    }
}

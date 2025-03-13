<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    // List all designations
    public function index()
    {
        $designations = Designation::all();
        return view('admin.designations.index', compact('designations'));
    }

    // Show the form for creating a new designation
    public function create()
    {
        return view('admin.designations.create');
    }

    // Store a new designation
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
    
        $designation = new Designation();
        $designation->title = $request->title;
        $designation->status = $request->status;
        $designation->save();
    
        return response()->json(['success' => true, 'message' => 'Designation added successfully!']);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
    
        $designation = Designation::findOrFail($id);
        $designation->title = $request->title;
        $designation->status = $request->status;
        $designation->save();
    
        return response()->json(['success' => true, 'message' => 'Designation updated successfully!']);
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('admin.designations.edit', compact('designation'));
    }
}
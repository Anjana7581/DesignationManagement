<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('admin.designations.index', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        Designation::create(['title' => $request->title, 'status' => $request->status]);

        return response()->json(['message' => 'Designation added successfully']);
    }
}

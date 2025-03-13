<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDesignations = Designation::count();
        $totalUsers = User::count();
        $activeUsers = User::where('status', 1)->count();  // Assuming '1' is active
        $inactiveUsers = User::where('status', 0)->count();  // Assuming '0' is inactive

        return view('admin.dashboard', compact('totalDesignations', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }
}

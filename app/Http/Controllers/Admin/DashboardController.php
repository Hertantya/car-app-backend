<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Models\UserPreference;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalCars  = Car::count();
        $totalLikes = UserPreference::where('action', 'like')->count();
        $totalSkips = UserPreference::where('action', 'skip')->count();

        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCars',
            'totalLikes',
            'totalSkips',
            'recentUsers'
        ));
    }
}

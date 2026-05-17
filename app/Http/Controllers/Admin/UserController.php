<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount([
                'preferences as likes_count'  => fn($q) => $q->where('action', 'like'),
                'preferences as skips_count'  => fn($q) => $q->where('action', 'skip'),
                'preferences as total_swipes' => fn($q) => $q,
            ])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Full swipe history
        $preferences = $user->preferences()
            ->with('car')
            ->latest()
            ->paginate(20);

        // Most liked brand
        $topBrand = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $user->id)
            ->where('user_preferences.action', 'like')
            ->select('cars.brand', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.brand')
            ->orderByDesc('total')
            ->first();

        // Most liked model
        $topModel = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $user->id)
            ->where('user_preferences.action', 'like')
            ->select('cars.brand', 'cars.model', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.brand', 'cars.model')
            ->orderByDesc('total')
            ->first();

        // Most liked type
        $topType = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $user->id)
            ->where('user_preferences.action', 'like')
            ->select('cars.type', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.type')
            ->orderByDesc('total')
            ->first();

        return view('admin.users.show', compact(
            'user',
            'preferences',
            'topBrand',
            'topModel',
            'topType'
        ));
    }
}

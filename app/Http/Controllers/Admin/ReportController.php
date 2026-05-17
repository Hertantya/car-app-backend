<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount(['preferences as likes_count' => fn($q) => $q->where('action', 'like')])
            ->having('likes_count', '>', 0)
            ->get();

        $reports = $users->map(function ($user) {
            $topBrand = DB::table('user_preferences')
                ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
                ->where('user_preferences.user_id', $user->id)
                ->where('user_preferences.action', 'like')
                ->select('cars.brand', DB::raw('COUNT(*) as total'))
                ->groupBy('cars.brand')
                ->orderByDesc('total')
                ->first();

            $topModel = DB::table('user_preferences')
                ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
                ->where('user_preferences.user_id', $user->id)
                ->where('user_preferences.action', 'like')
                ->select('cars.brand', 'cars.model', DB::raw('COUNT(*) as total'))
                ->groupBy('cars.brand', 'cars.model')
                ->orderByDesc('total')
                ->first();

            $topType = DB::table('user_preferences')
                ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
                ->where('user_preferences.user_id', $user->id)
                ->where('user_preferences.action', 'like')
                ->select('cars.type', DB::raw('COUNT(*) as total'))
                ->groupBy('cars.type')
                ->orderByDesc('total')
                ->first();

            return [
                'user'      => $user,
                'topBrand'  => $topBrand,
                'topModel'  => $topModel,
                'topType'   => $topType,
            ];
        });

        return view('admin.reports.index', compact('reports'));
    }
}

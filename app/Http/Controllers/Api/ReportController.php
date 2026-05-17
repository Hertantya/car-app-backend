<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $topBrand = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $userId)
            ->where('user_preferences.action', 'like')
            ->select('cars.brand', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.brand')
            ->orderByDesc('total')
            ->first();

        $topModel = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $userId)
            ->where('user_preferences.action', 'like')
            ->select('cars.brand', 'cars.model', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.brand', 'cars.model')
            ->orderByDesc('total')
            ->first();

        $topType = DB::table('user_preferences')
            ->join('cars', 'cars.id', '=', 'user_preferences.car_id')
            ->where('user_preferences.user_id', $userId)
            ->where('user_preferences.action', 'like')
            ->select('cars.type', DB::raw('COUNT(*) as total'))
            ->groupBy('cars.type')
            ->orderByDesc('total')
            ->first();

        $totalLikes = DB::table('user_preferences')
            ->where('user_id', $userId)
            ->where('action', 'like')
            ->count();

        $totalSkips = DB::table('user_preferences')
            ->where('user_id', $userId)
            ->where('action', 'skip')
            ->count();

        return response()->json([
            'most_liked_brand' => $topBrand?->brand,
            'most_liked_model' => $topModel ? "{$topModel->brand} {$topModel->model}" : null,
            'most_liked_type'  => $topType?->type,
            'total_likes'      => $totalLikes,
            'total_skips'      => $totalSkips,
        ]);
    }
}

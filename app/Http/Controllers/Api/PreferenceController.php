<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|integer|exists:cars,id',
            'action' => 'required|in:like,skip',
        ]);

        // Upsert: insert or update if already swiped
        $preference = UserPreference::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'car_id'  => $validated['car_id'],
            ],
            [
                'action' => $validated['action'],
            ]
        );

        return response()->json([
            'message'    => 'Preference saved.',
            'preference' => $preference,
        ], 201);
    }

    public function index(Request $request)
    {
        $preferences = $request->user()
            ->preferences()
            ->with('car:id,brand,model,type,image_url')
            ->latest()
            ->get();

        return response()->json(['data' => $preferences]);
    }

    /**
     * Sync multiple offline swipes at once.
     * Mobile app sends an array of preferences when coming back online.
     */
    public function sync(Request $request)
    {
        $request->validate([
            'preferences'           => 'required|array|min:1',
            'preferences.*.car_id'  => 'required|integer|exists:cars,id',
            'preferences.*.action'  => 'required|in:like,skip',
        ]);

        $userId = $request->user()->id;
        $synced = 0;

        foreach ($request->preferences as $item) {
            UserPreference::updateOrCreate(
                ['user_id' => $userId, 'car_id' => $item['car_id']],
                ['action'  => $item['action']]
            );
            $synced++;
        }

        return response()->json([
            'message' => "{$synced} preferences synced successfully.",
            'synced'  => $synced,
        ]);
    }
}

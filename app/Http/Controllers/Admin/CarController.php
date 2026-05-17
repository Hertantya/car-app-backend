<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::withCount([
            'preferences as likes_count' => fn($q) => $q->where('action', 'like'),
            'preferences as skips_count' => fn($q) => $q->where('action', 'skip'),
        ])->latest()->paginate(15);

        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $types = ['Sedan', 'SUV', 'Hatchback', 'Sports', 'Truck', 'Coupe', 'Convertible'];
        return view('admin.cars.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'     => 'required|string|max:100',
            'model'     => 'required|string|max:100',
            'type'      => 'required|in:Sedan,SUV,Hatchback,Sports,Truck,Coupe,Convertible',
            'image_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully.');
    }

    public function toggleActive(Car $car)
    {
        $car->update(['is_active' => !$car->is_active]);
        $status = $car->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Car {$status} successfully.");
    }
}

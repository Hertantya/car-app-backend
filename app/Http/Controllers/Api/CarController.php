<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::active()
            ->select('id', 'brand', 'model', 'type', 'image_url')
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $cars]);
    }
}

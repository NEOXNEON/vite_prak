<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $storeys = $request->input('storeys');
        $garages = $request->input('garages');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $query = House::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($bedrooms) {
            $query->where('bedrooms', $bedrooms);
        }

        if ($bathrooms) {
            $query->where('bathrooms', $bathrooms);
        }

        if ($storeys) {
            $query->where('storeys', $storeys);
        }

        if ($garages) {
            $query->where('garages', $garages);
        }

        if ($price_from && $price_to) {
            $query->whereBetween('price', [$price_from, $price_to]);
        }

        $houses = $query->get();

        return response()->json($houses);
    }
}
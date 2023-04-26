<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentImage;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function showAllApartments()
    {
        return response()->json(Apartment::all());
    }

    public function showOneApartment($id)
    {
        $apartment = Apartment::find($id);
        $thumbnail = ApartmentImage::where('id', $apartment->id)->get();
        $apartment->thumbnail = $thumbnail;
        return response()->json($apartment);
    }

    public function create(Request $request)
    {
        $apartment = Apartment::create($request->all());

        return response()->json($apartment, 201);
    }

    public function update($id, Request $request)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->update($request->all());

        return response()->json($apartment, 200);
    }

    public function delete($id)
    {
        Apartment::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $cities = City::all();
        if ($request->has('search')) {
            $cities = City::where('name', 'like', '%' . $request->search . '%')->get();
        }
        return view('admin.city.index', compact('cities'));
    }


    public function create()
    {
        $states = State::all();
        return view('admin.city.create', compact( 'states'));
    }


    public function store(CityStoreRequest $request)
    {
        City::create($request->validated());
        return redirect()->route('cities.index')->with('success', 'City created successfully');
    }

    public function edit(City $city)
    {
        $states = State::all();
        return view('admin.city.edit', compact('city',  'states'));
    }


    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->validated());
        return redirect()->route('cities.index')->with('success', 'City updated successfully');
    }


    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->back()->with('success', 'City deleted successfully');
    }
}

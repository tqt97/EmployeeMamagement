<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::all();
        if ($request->has('search')) {
            $countries = Country::where('name', 'like', "%{$request->search}%")
                ->orWhere('country_code', 'like', "%{$request->search}%")
                ->get();
        }
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }
    public function store(CountryStoreRequest $request)
    {
        Country::create($request->validated());
        return redirect()->route('countries.index')->with('success', 'Created country successful');
    }
    public function show(Country $country)
    {
        //
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->update($request->validated());
        return redirect()->route('countries.index')->with('success', 'Updated country successful');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('success', 'Deleted country successful');
    }
}

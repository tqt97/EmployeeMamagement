<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateStoreRequest;
use App\Http\Requests\StateUpdateRequest;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::all();
        if ($request->has('search')) {
            $states = State::where('name', 'like', "%{$request->search}%")
                ->get();
        }
        return view('admin.state.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.state.create', compact('countries'));
    }
    public function store(StateStoreRequest $request)
    {
        State::create($request->validated());
        return redirect()->route('states.index')->with('success', 'Created State successful');
    }
    public function show(State $state)
    {
        //
    }

    public function edit(State $state)
    {
        $countries = Country::all();
        return view('admin.state.edit', compact('state', 'countries'));
    }

    public function update(StateUpdateRequest $request, State $state)
    {
        $state->update($request->validated());
        return redirect()->route('states.index')->with('success', 'Updated State successful');
    }

    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('states.index')->with('success', 'Deleted State successful');
    }
}

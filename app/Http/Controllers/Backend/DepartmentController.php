<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        $departments = Department::all();
        if ($departments->count() == 0) {
            return redirect()->route('departments.create')->with('success', 'Please create a department first');
        }
        if($request->has('search')) {
            $departments = Department::where('name', 'like', "%{$request->search}%")
                ->get();
        }
        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.department.create');
    }


    public function store(DepartmentStoreRequest $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }


    public function edit(Department $department)
    {
        return view('admin.department.edit', compact('department'));
    }


    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }


    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully');
    }
}

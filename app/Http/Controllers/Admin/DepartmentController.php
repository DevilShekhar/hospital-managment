<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // Status 1 aslele active departments fetch hotiil (0 wale hide hotiil)
        $departments = Department::where('status', 1)->latest()->get();

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
            'status'      => 'nullable',
        ]);

        // Form madhun 'active', '1', kiwa true aala tar 1 hoil, nahi tar 0
        $statusValue = in_array($request->status, ['active', '1', 1, true], true) ? 1 : 0;

        Department::create([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $statusValue,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string',
            'status'      => 'nullable',
        ]);

        // Form madhun 'active', '1', kiwa true aala tar 1 hoil, nahi tar 0
        $statusValue = in_array($request->status, ['active', '1', 1, true], true) ? 1 : 0;

        $department->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $statusValue,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->update([
            'status' => 0, // Soft delete by setting status to 0 (inactive)
        ]);

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
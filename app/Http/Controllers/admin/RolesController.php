<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    
    public function index()
    {
        $roles = Role::latest()->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:roles,name',
            'status' => 'required|boolean',
        ]);

        Role::create([
            'name'       => $request->name,
            'guard_name' => 'web',
            'status'     => $request->status,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:roles,name,' . $role->id,
            'status' => 'required|boolean',
        ]);

        $role->update([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Soft Delete: Update status to 0 instead of deleting row
     */
    public function destroy(Role $role)
    {
        // Record DB madhun delete na karta status 0 kela
        $role->update([
            'status' => 0
        ]);

         return redirect()->route('roles.index')->with('success', 'Role marked as inactive successfully.');
    }
}
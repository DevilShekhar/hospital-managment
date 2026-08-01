<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    
    public function index()
    {
        // Status 1 aslele roles dakhva (Status 0 wale hide hotiil)
        $roles = Role::where('status', 1)->latest()->paginate(10);
        
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create([
            'name'       => $request->name,
            'guard_name' => 'web',
            'status'     => 1, 
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
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
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

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
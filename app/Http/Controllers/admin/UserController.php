<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with(['roles', 'department'])->latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.user.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created user in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'employee_id'   => 'required|string|max:100|unique:users,employee_id',
            'email'         => 'required|email|max:255|unique:users,email',
            'mobile'        => 'required|string|max:20',
            'gender'        => 'nullable|string|in:Male,Female,Other',
            'dob'           => 'nullable|date',
            'department_id' => 'required|exists:departments,id',
            'role'          => 'required|exists:roles,name',
            'password'      => 'required|string|min:8|confirmed',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:1,0',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'pincode'       => 'nullable|string|max:20',
        ]);

        // Handle Photo Upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users/photos', 'public');
        }

        // Create User
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'employee_id'   => $request->employee_id,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'gender'        => $request->gender,
            'dob'           => $request->dob,
            'department_id' => $request->department_id,
            'password'      => Hash::make($request->password),
            'photo'         => $photoPath,
            'status'        => $request->status,
            'address'       => $request->address,
            'city'          => $request->city,
            'state'         => $request->state,
            'pincode'       => $request->pincode,
        ]);

        // Assign Role
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user profile details.
     */
    public function show(User $user)
    {
        $user->load(['department', 'roles']);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->first();

        return view('admin.user.edit', compact('user', 'departments', 'roles', 'userRole'));
    }

    /**
     * Update the specified user in database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'employee_id'   => 'required|string|max:100|unique:users,employee_id,' . $user->id,
            'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile'        => 'required|string|max:20',
            'gender'        => 'nullable|string|in:Male,Female,Other',
            'dob'           => 'nullable|date',
            'department_id' => 'required|exists:departments,id',
            'role'          => 'required|exists:roles,name',
            'password'      => 'nullable|string|min:8|confirmed',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:1,0',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'pincode'       => 'nullable|string|max:20',
        ]);

        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'employee_id'   => $request->employee_id,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'gender'        => $request->gender,
            'dob'           => $request->dob,
            'department_id' => $request->department_id,
            'status'        => $request->status,
            'address'       => $request->address,
            'city'          => $request->city,
            'state'         => $request->state,
            'pincode'       => $request->pincode,
        ];

        // Update Password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle Photo Upload & Delete Old Image
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $request->file('photo')->store('users/photos', 'public');
        }

        $user->update($data);

        // Sync Roles
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from database.
     */
    public function destroy(User $user)
    {
        // Delete profile photo if exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
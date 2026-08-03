<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of ACTIVE users (status = 1).
     */
    public function index()
    {
        // Status 1 aslele users fetch hotiil (Status 0 wale list madhun hide hotiil)
        $users = User::with(['roles', 'department'])
                     ->where('status', 1)
                     ->latest()
                     ->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::select('id', 'name')->get();
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
            'role_id'       => 'required|exists:roles,id',
            'password'      => 'required|string|min:8|confirmed',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:1,0',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'pincode'       => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Upload Photo
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
                'role_id'       => $request->role_id, // Optional
            ]);
            // Get Role by ID
            $role = Role::findOrFail($request->role_id);
            // Assign Role (Spatie)
            $user->assignRole($role->name);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(User $user)
    {
        $user->load(['department', 'roles']);
        return view('admin.user.show', compact('user'));
    }

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

    public function destroy(User $user)
    {
        $user->update([
            'status' => 0
        ]);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Specialist;
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
        // Added 'specialist' relationship in eager loading
        $users = User::with(['roles', 'department', 'specialist'])
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
        $specialists = Specialist::where('status', 1)->get(); // Fetched active specialists
        
        return view('admin.user.create', compact('departments', 'roles', 'specialists'));
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
            'specialist_id' => 'nullable|exists:specialists,id',
            'password'      => 'required|string|min:8|confirmed',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                'specialist_id' => $request->specialist_id,
                'password'      => Hash::make($request->password),
                'photo'         => $photoPath,
                'status'        => 1,
                'address'       => $request->address,
                'city'          => $request->city,
                'state'         => $request->state,
                'pincode'       => $request->pincode,
                'role_id'       => $request->role_id,
            ]);

            // Get Role by ID & Assign Role (Spatie)
            $role = Role::findOrFail($request->role_id);
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
        // Added 'specialist' relationship
        $user->load(['department', 'roles', 'specialist']);
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = Role::pluck('name', 'name')->all();
        $specialists = Specialist::where('status', 1)->get(); // Passed specialists to edit view
        $userRole = $user->roles->pluck('name', 'name')->first();

        return view('admin.user.edit', compact('user', 'departments', 'roles', 'userRole', 'specialists'));
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
            'specialist_id' => 'nullable|exists:specialists,id',
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
            'specialist_id' => $request->specialist_id,
            'status'        => $request->status,
            'address'       => $request->address,
            'city'          => $request->city,
            'state'         => $request->state,
            'pincode'       => $request->pincode,
        ];

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
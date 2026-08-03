<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of Doctors from Users table.
     */
    public function index(Request $request)
    {
        // Fakt Users table madhun Doctors fetch karat aahot
        $query = User::role('Doctor')
                    ->with('department')
                    ->where('status', 1);

        // Search Filter (First Name, Last Name, Email, Employee ID)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%");
            });
        }

        $doctors = $query->latest()->paginate(10);

        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Add Doctor -> Redirects to Users Create
     */
    public function create()
    {
        return redirect()->route('users.create');
    }

    /**
     * Show Doctor Profile
     */
    public function show($id)
    {
        $doctor = User::role('Doctor')->with('department')->findOrFail($id);
        return view('admin.doctor.show', compact('doctor'));
    }

    /**
     * Edit Doctor
     */
    public function edit($id)
    {
        $doctor = User::role('Doctor')->with('department')->findOrFail($id);
        $departments = Department::where('status', 1)->get();

        return view('admin.doctor.edit', compact('doctor', 'departments'));
    }

    /**
     * Update Doctor in Users table
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'mobile'        => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'password'      => 'nullable|string|min:8',
        ]);

        $userData = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'department_id' => $request->department_id,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        

        $user->update($userData);

        return redirect()->route('doctors.index')->with('success', 'Doctor details updated successfully.');
    }
    

    /**
     * Soft Delete Doctor (status = 0 in Users table)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 0]);

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
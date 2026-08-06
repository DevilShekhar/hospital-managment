<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::with(['department', 'roles', 'specialist'])
            ->role('Doctor')
            ->where('status', 1)
            ->latest()
            ->paginate(10);

        return view('admin.doctor.index', compact('doctors'));
    }

    public function show(User $doctor)
    {
        $doctor->load(['department', 'roles', 'specialist']);
        return view('admin.doctor.show', compact('doctor'));
    }

    public function edit(User $doctor)
    {
        $departments = Department::all();
        $specialists = Specialist::where('status', 1)->get();
        return view('admin.doctor.edit', compact('doctor', 'departments', 'specialists'));
    }

    public function update(Request $request, User $doctor)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $doctor->id,
            'mobile'        => 'required|regex:/^[0-9]+$/|max:20',
            'department_id' => 'required|exists:departments,id',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'department_id' => $request->department_id,
        ];

        if ($request->hasFile('photo')) {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('users/photos', 'public');
        }

        $doctor->update($data);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(User $doctor)
    {
        $doctor->update(['status' => 0]);
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
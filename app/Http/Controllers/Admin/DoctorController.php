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
        $doctors = User::withTrashed()
            ->with(['department', 'roles', 'specialist'])
            ->role('Doctor')
            ->latest()
            ->paginate(10);

        return view('admin.doctor.index', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = User::withTrashed()->findOrFail($id);
        $doctor->load(['department', 'roles', 'specialist']);
        return view('admin.doctor.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = User::withTrashed()->findOrFail($id);
        $departments = Department::all();
        $specialists = Specialist::where('status', 1)->get();
        return view('admin.doctor.edit', compact('doctor', 'departments', 'specialists'));
    }
    public function update(Request $request, $id)
    {
        $doctor = User::withTrashed()->findOrFail($id);
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $doctor->id,
            'mobile'        => 'required|regex:/^[0-9]+$/|max:20',
            'department_id' => 'required|exists:departments,id',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:1,0',
        ]);

        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'department_id' => $request->department_id,
            'status'        => $request->status,
        ];

        if ($request->hasFile('photo')) {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('users/photos', 'public');
        }

        $doctor->update($data);

        if ($request->status == 1 && $doctor->trashed()) {
            $doctor->restore();
        }
        if ($request->status == 0 && !$doctor->trashed()) {
            $doctor->delete();
        }
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(User $doctor)
    {
        $doctor->status = 0;
        $doctor->save();
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
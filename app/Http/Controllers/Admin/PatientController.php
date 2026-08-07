<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Department;
use App\Models\User;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['doctor', 'department'])
                    ->latest()
                    ->paginate(10);

        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $doctors = collect();

        return view('admin.patients.create', compact('departments', 'doctors'));
    }

    // Dynamic AJAX Call
    public function getDoctorsByDepartment(Request $request)
    {
        $doctors = User::where('department_id', $request->department_id)
            ->get(['id', 'first_name', 'last_name', 'name']);

        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id'              => 'required|unique:patients,patient_id',
            'first_name'              => 'required|string|max:100',
            'last_name'               => 'required|string|max:100',
            'gender'                  => 'required',
            'date_of_birth'           => 'required|date',
            'phone'                   => 'required|unique:patients,phone',
            'email'                   => 'nullable|email|unique:patients,email',
            'blood_group'             => 'nullable|string',
            'marital_status'          => 'nullable|string',
            'department_id'           => 'required|exists:departments,id',
            'doctor_id'               => 'required|exists:users,id', 
            'address'                 => 'required|string',
            'city'                    => 'nullable|string',
            'state'                   => 'nullable|string',
            'country'                 => 'nullable|string',
            'pin_code'                => 'nullable|string',
            'emergency_contact_name'  => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'relation'                => 'nullable|string',
            'medical_history'         => 'nullable|string',
            'allergies'               => 'nullable|string',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')
                        ->with('success', 'Patient added successfully.');
    }

    public function edit(Patient $patient)
    {
        $departments = Department::where('status', 1)->get();

        
            $doctors = User::where('department_id', $patient->department_id)
            ->get(['id', 'first_name', 'last_name', 'name']);

        return view('admin.patients.edit', compact(
            'patient',
            'departments',
            'doctors'
        ));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'patient_id'              => 'required|unique:patients,patient_id,' . $id,
            'first_name'              => 'required|string|max:100',
            'last_name'               => 'required|string|max:100',
            'gender'                  => 'required',
            'date_of_birth'           => 'required|date',
            'phone'                   => 'required|unique:patients,phone,' . $id,
            'email'                   => 'nullable|email|unique:patients,email,' . $id,
            'blood_group'             => 'nullable|string',
            'marital_status'          => 'nullable|string',
            'department_id'           => 'required|exists:departments,id',
            'doctor_id'               => 'required|exists:users,id',
            'address'                 => 'required|string',
            'city'                    => 'nullable|string',
            'state'                   => 'nullable|string',
            'country'                 => 'nullable|string',
            'pin_code'                => 'nullable|string',
            'emergency_contact_name'  => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'relation'                => 'nullable|string',
            'medical_history'         => 'nullable|string',
            'allergies'               => 'nullable|string',
            'status'                  => 'required|boolean',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $patient->update([
            'status' => 0,
            'deleted_at' => now(),
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient marked as inactive successfully.');
    }
}
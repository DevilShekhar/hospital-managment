<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Doctor;


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
        $departments = Department::where('status', 'Active')->get();
        $doctors = Doctor::orderBy('first_name')->get();

        return view('admin.patients.create', compact(
            'departments',
            'doctors'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|unique:patients,patient_id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'phone' => 'required|unique:patients,phone',
            'email' => 'nullable|email|unique:patients,email',
            'blood_group' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'address' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'relation' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
        ]);

        Patient::create([
            'patient_id' => $request->patient_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
            'blood_group' => $request->blood_group,
            'marital_status' => $request->marital_status,
            'department_id' => $request->department_id,
            'doctor_id' => $request->doctor_id,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pin_code' => $request->pin_code,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'relation' => $request->relation,
            'medical_history' => $request->medical_history,
            'allergies' => $request->allergies,
        ]);

        return redirect()->route('patients.index')
                        ->with('success', 'Patient added successfully.');
    }
    public function edit(Patient $patient)
    {
        $departments = Department::where('status', 'active')->get();
        $doctors = Doctor::orderBy('first_name')->get();

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
            'patient_id' => 'required|unique:patients,patient_id,' . $id,
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'phone' => 'required|unique:patients,phone,' . $id,
            'email' => 'nullable|email|unique:patients,email,' . $id,
            'blood_group' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'address' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'relation' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
                        ->with('success', 'Patient updated successfully.');
    }
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();

        return redirect()->route('patients.index')
                        ->with('success', 'Patient deleted successfully.');
    }
}

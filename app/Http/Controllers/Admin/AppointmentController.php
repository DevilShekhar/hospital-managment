<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Specialist;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch appointments with relations (Soft deleted items will be automatically excluded)
        $query = Appointment::with(['department', 'specialist', 'doctor', 'patient']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'LIKE', "%{$search}%")
                  ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                  ->orWhere('appointment_no', 'LIKE', "%{$search}%");
            });
        }

        $appointments = $query->latest()->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $specialists = Specialist::where('status', 1)->get();
        $doctors     = User::whereNotNull('department_id')->get();
        $patients    = Patient::latest()->get();

        return view('admin.appointments.create', compact('departments', 'specialists', 'doctors', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id'       => 'nullable',
            'patient_name'     => 'required|string|max:255',
            'mobile_number'    => 'required|digits:10',
            'department_id'    => 'required',
            'doctor_id'        => 'required',
            'specialist_id'    => 'nullable',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        $data = $request->all();

        // Auto generate Appointment Number if empty
        if (empty($data['appointment_no'])) {
            $data['appointment_no'] = 'APT' . date('YmdHis');
        }

        $data['status'] = $request->status ?? 'Scheduled';

        Appointment::create($data);

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $departments = Department::where('status', 1)->get();
        $specialists = Specialist::where('status', 1)->get();
        $doctors     = User::whereNotNull('department_id')->get();
        $patients    = Patient::latest()->get();

        return view('admin.appointments.edit', compact('appointment', 'departments', 'specialists', 'doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_name'     => 'required|string|max:255',
            'mobile_number'    => 'required|digits:10',
            'department_id'    => 'required',
            'doctor_id'        => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(Appointment $appointment)
    {
        // Executes Soft Delete (updates deleted_at timestamp)
        $appointment->delete();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment deleted successfully.');
    }
}
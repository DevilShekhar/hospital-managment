<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
{
    $appointments = Appointment::with(['department', 'doctor'])
                    ->latest()
                    ->paginate(10);

    return view('admin.appointments.index', compact('appointments'));
}

    public function create()
    {
        $departments = Department::all();
        $doctors = Doctor::all();

        return view('admin.appointments.create', compact('departments', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'patient_name'      => 'required|string|max:255',
        'mobile_number'     => 'required|digits:10',
        'department_id'     => 'required',
        'doctor_id'         => 'required',
        'appointment_date'  => 'required|date',
        'appointment_time'  => 'required',
    ]);

    Appointment::create($request->all());

    return redirect()->route('appointments.index')
                     ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}

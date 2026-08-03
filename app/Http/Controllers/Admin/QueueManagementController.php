<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\QueueManagement;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Appointment;




class QueueManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queues = QueueManagement::with([
                        'doctor',
                        'department'
                    ])
                    ->latest()
                    ->paginate(10);

        return view('admin.queues.index', compact('queues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::orderBy('first_name')->get();
        $departments = Department::where('status', 'active')->get();
        $appointments = Appointment::latest()->get();

        return view('admin.queues.create', compact(
            'doctors',
            'departments',
            'appointments'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'doctor_id'       => 'required|exists:doctors,id',
            'department_id'   => 'required|exists:departments,id',
            'appointment_id'  => 'required|exists:appointments,id',
            'specialist'      => 'required|string|max:255',
            'visit_date'      => 'required|date',
            'priority'        => 'required|in:Normal,Urgent,Emergency',
            'remarks'         => 'nullable|string',
        ]);

        QueueManagement::create([
            'queue_number'   => 'Q' . date('Ymd') . rand(100, 999),
            'patient_id'     => $request->patient_id,
            'doctor_id'      => $request->doctor_id,
            'department_id'  => $request->department_id,
            'appointment_id' => $request->appointment_id,
            'specialist'     => $request->specialist,
            'visit_date'     => $request->visit_date,
            'priority'       => $request->priority,
            'remarks'        => $request->remarks,
        ]);

        return redirect()
            ->route('queues.index')
            ->with('success', 'Queue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QueueManagement $queueManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $queue = QueueManagement::findOrFail($id);

        $doctors = Doctor::orderBy('first_name')->get();
        $departments = Department::where('status', 'active')->get();
        $appointments = Appointment::latest()->get();

        return view('admin.queues.edit', compact(
            'queue',
            'doctors',
            'departments',
            'appointments'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id'      => 'required|exists:doctors,id',
            'department_id'  => 'required|exists:departments,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'specialist'     => 'required|string|max:255',
            'visit_date'     => 'required|date',
            'priority'       => 'required|in:Normal,Urgent,Emergency',
            'remarks'        => 'nullable|string',
        ]);

        $queue = QueueManagement::findOrFail($id);

        $queue->update([
            'doctor_id'      => $request->doctor_id,
            'department_id'  => $request->department_id,
            'appointment_id' => $request->appointment_id,
            'specialist'     => $request->specialist,
            'visit_date'     => $request->visit_date,
            'priority'       => $request->priority,
            'remarks'        => $request->remarks,
        ]);

        return redirect()->route('queues.index')
                        ->with('success', 'Queue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QueueManagement $queueManagement)
    {
        //
    }
}

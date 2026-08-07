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
        $query = Appointment::with([
        'department',
        'specialist',
        'doctor',
        'patient'
    ]);

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('patient_name', 'LIKE', "%{$search}%")
              ->orWhere('mobile_number', 'LIKE', "%{$search}%")
              ->orWhere('appointment_no', 'LIKE', "%{$search}%");
        });
    }

    $appointments = $query->latest()->paginate(10);

    return view('admin.appointments.index', compact('appointments'));
}

    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $specialists = Specialist::where('status', 1)->get();
        $doctors     = User::whereNotNull('department_id')->get();
        $patients    = Patient::latest()->get();

        return view('admin.appointments.create', compact('departments', 'specialists', 'doctors', 'patients'));
    }

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
            'appointment_status'=> 'required|in:Scheduled,Confirmed,Completed,Cancelled',
        ]);
        $data = $request->all();
        if (empty($data['appointment_no'])) {
            $data['appointment_no'] = 'APT' . date('YmdHis');
        }
        // Appointment progress status
        $data['appointment_status'] = $request->appointment_status;
        $data['status'] = 1;
        $data['deleted_at'] = null;

        Appointment::create($data);
         return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }
   public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id); 
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'mobile_number' => 'required|digits:10',
            'department_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:Scheduled,Confirmed,Completed,Cancelled',
            'is_active' => 'required|in:0,1',
        ]);
       $appointment->update([
            'patient_id' => $request->patient_id,
            'patient_name' => $request->patient_name,
            'mobile_number' => $request->mobile_number,
            'department_id' => $request->department_id,
            'doctor_id' => $request->doctor_id,
            'specialist_id' => $request->specialist_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,

            'status' => $request->status,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('appointments.index')
                         ->with('success','Appointment updated successfully.');
    }
 
     public function destroy(Appointment $appointment)
    {
        $appointment->update([
            'is_active' => 0,
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success','Appointment deleted successfully.');
    }
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $departments = Department::where('status',1)->get();
        $specialists = Specialist::where('status',1)->get();
        $doctors = User::whereNotNull('department_id')->get();
        $patients = Patient::latest()->get();

        return view('admin.appointments.edit', compact(
            'appointment',
            'departments',
            'specialists',
            'doctors',
            'patients'
        ));
    }
    public function show($id)
    {
        $appointment = Appointment::with([
            'department',
            'specialist',
            'doctor',
            'patient'
        ])->findOrFail($id);

        return view('admin.appointments.show', compact('appointment'));
    }
}
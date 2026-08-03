<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Department;


class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DoctorSchedule::with(['doctor', 'department']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('doctor', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            })
            ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('schedule_date', 'like', "%{$search}%");
        }

        $doctorSchedules = $query->latest()->paginate(10);

        return view('admin.doctor_schedule.index', compact('doctorSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();
        $departments = Department::all();

        return view('admin.doctor_schedule.create', compact('doctors', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $request->validate([
            'doctor_id'         => 'required|exists:doctors,id',
            'department_id'     => 'required|exists:departments,id',
            'schedule_date'     => 'required|date',
            'day_of_week'       => 'required|string',
            'start_time'        => 'required',
            'end_time'          => 'required|after:start_time',
            'slot_duration'     => 'required|integer|min:5',
            'max_patients'      => 'required|integer|min:1',
            'room_no'           => 'nullable|string|max:50',
            'consultation_fee'  => 'nullable|numeric|min:0',
            'is_available'      => 'required|boolean',
            'remarks'           => 'nullable|string|max:500',
        ]);

        $doctorSchedule->update([
            'doctor_id'        => $request->doctor_id,
            'department_id'    => $request->department_id,
            'schedule_date'    => $request->schedule_date,
            'day_of_week'      => $request->day_of_week,
            'start_time'       => $request->start_time,
            'end_time'         => $request->end_time,
            'slot_duration'    => $request->slot_duration,
            'max_patients'     => $request->max_patients,
            'room_no'          => $request->room_no,
            'consultation_fee' => $request->consultation_fee,
            'is_available'     => $request->is_available,
            'remarks'          => $request->remarks,
        ]);

        return redirect()
                ->route('doctor-schedules.index')
                ->with('success', 'Doctor Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSchedule $doctorSchedule)
    {
        //
    }
}

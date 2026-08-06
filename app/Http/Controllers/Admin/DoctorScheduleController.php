<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // Included Carbon for automatic day calculation

class DoctorScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Fetch active schedules where status = 1 and not soft deleted
        $query = DoctorSchedule::with(['doctor', 'department'])
                               ->where('status', 1);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->whereHas('doctor', function ($docQ) use ($search) {
                    $docQ->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('name', 'like', "%{$search}%");
                })
                ->orWhereHas('department', function ($deptQ) use ($search) {
                    $deptQ->where('name', 'like', "%{$search}%")
                          ->orWhere('department_name', 'like', "%{$search}%");
                })
                ->orWhere('schedule_date', 'like', "%{$search}%")
                ->orWhere('day_of_week', 'like', "%{$search}%");
            });
        }

        $doctorSchedules = $query->latest()->paginate(10);

        return view('admin.doctor_schedule.index', compact('doctorSchedules'));
    }

    public function create()
    {
        $doctors = User::whereNotNull('department_id')->get();
        $departments = Department::where('status', 1)->get();

        return view('admin.doctor_schedule.create', compact('doctors', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id'        => 'required',
            'department_id'    => 'required',
            'schedule_date'    => 'required|date',
            'day_of_week'      => 'nullable|string', // Set to nullable for auto-calculation
            'start_time'       => 'required',
            'end_time'         => 'required',
            'slot_duration'    => 'nullable|integer',
            'max_patients'     => 'nullable|integer',
            'room_no'          => 'nullable|string',
            'consultation_fee' => 'nullable|numeric',
            'is_available'     => 'required|boolean',
            'remarks'          => 'nullable|string',
        ]);

        // Auto-calculate day of the week from schedule_date
        $validated['day_of_week'] = Carbon::parse($request->schedule_date)->format('l');

        // Automatically set status = 1 (Active)
        $validated['status'] = 1;

        DoctorSchedule::create($validated);

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule created successfully.');
    }

    public function edit(DoctorSchedule $doctorSchedule)
    {
        $doctors = User::whereNotNull('department_id')->get();
        $departments = Department::where('status', 1)->get();

        return view('admin.doctor_schedule.edit', compact('doctorSchedule', 'doctors', 'departments'));
    }

    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $validated = $request->validate([
            'doctor_id'        => 'required',
            'department_id'    => 'required',
            'schedule_date'    => 'required|date',
            'day_of_week'      => 'nullable|string', // Set to nullable for auto-calculation
            'start_time'       => 'required',
            'end_time'         => 'required',
            'slot_duration'    => 'nullable|integer',
            'max_patients'     => 'nullable|integer',
            'room_no'          => 'nullable|string',
            'consultation_fee' => 'nullable|numeric',
            'is_available'     => 'required|boolean',
            'status'           => 'required|in:0,1',
            'remarks'          => 'nullable|string',
        ]);

        // Recalculate day of the week on update
        $validated['day_of_week'] = Carbon::parse($request->schedule_date)->format('l');

        $doctorSchedule->update($validated);

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule updated successfully.');
    }

    public function destroy(DoctorSchedule $doctorSchedule)
    {
        // Set status to 0 (Inactive) and soft delete record
        $doctorSchedule->update(['status' => 0]);
        $doctorSchedule->delete();

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule deleted successfully.');
    }
}
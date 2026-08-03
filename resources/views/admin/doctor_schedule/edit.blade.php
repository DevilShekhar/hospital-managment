@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">Edit Doctor Schedule</h4>

                    <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>

                </div>

                <div class="card-body">

                    <form action="{{ route('doctor-schedules.update', $doctorSchedule->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- Doctor -->
                            <div class="col-md-6 mb-3">
                                <label>Doctor <span class="text-danger">*</span></label>

                                <select name="doctor_id" class="form-control" required>

                                    <option value="">Select Doctor</option>

                                    @foreach($doctors as $doctor)

                                        <option value="{{ $doctor->id }}"
                                            {{ old('doctor_id', $doctorSchedule->doctor_id) == $doctor->id ? 'selected' : '' }}>

                                            Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6 mb-3">

                                <label>Department <span class="text-danger">*</span></label>

                                <select name="department_id" class="form-control" required>

                                    <option value="">Select Department</option>

                                    @foreach($departments as $department)

                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', $doctorSchedule->department_id) == $department->id ? 'selected' : '' }}>

                                            {{ $department->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <!-- Schedule Date -->
                            <div class="col-md-6 mb-3">

                                <label>Schedule Date</label>

                                <input
                                    type="date"
                                    name="schedule_date"
                                    class="form-control"
                                    value="{{ old('schedule_date', $doctorSchedule->schedule_date) }}"
                                    required>

                            </div>

                            <!-- Day -->
                            <div class="col-md-6 mb-3">

                                <label>Day Of Week</label>

                                <select name="day_of_week" class="form-control">

                                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)

                                        <option value="{{ $day }}"
                                            {{ old('day_of_week', $doctorSchedule->day_of_week) == $day ? 'selected' : '' }}>

                                            {{ $day }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <!-- Start Time -->
                            <div class="col-md-6 mb-3">

                                <label>Start Time</label>

                                <input
                                    type="time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time', $doctorSchedule->start_time) }}"
                                    required>

                            </div>

                            <!-- End Time -->
                            <div class="col-md-6 mb-3">

                                <label>End Time</label>

                                <input
                                    type="time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time', $doctorSchedule->end_time) }}"
                                    required>

                            </div>

                            <!-- Slot Duration -->
                            <div class="col-md-4 mb-3">

                                <label>Slot Duration (Minutes)</label>

                                <input
                                    type="number"
                                    name="slot_duration"
                                    class="form-control"
                                    value="{{ old('slot_duration', $doctorSchedule->slot_duration) }}">

                            </div>

                            <!-- Max Patients -->
                            <div class="col-md-4 mb-3">

                                <label>Maximum Patients</label>

                                <input
                                    type="number"
                                    name="max_patients"
                                    class="form-control"
                                    value="{{ old('max_patients', $doctorSchedule->max_patients) }}">

                            </div>

                            <!-- Room -->
                            <div class="col-md-4 mb-3">

                                <label>Room Number</label>

                                <input
                                    type="text"
                                    name="room_no"
                                    class="form-control"
                                    value="{{ old('room_no', $doctorSchedule->room_no) }}">

                            </div>

                            <!-- Consultation Fee -->
                            <div class="col-md-6 mb-3">

                                <label>Consultation Fee</label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="consultation_fee"
                                    class="form-control"
                                    value="{{ old('consultation_fee', $doctorSchedule->consultation_fee) }}">

                            </div>

                            <!-- Availability -->
                            <div class="col-md-6 mb-3">

                                <label>Availability</label>

                                <select name="is_available" class="form-control">

                                    <option value="1"
                                        {{ old('is_available', $doctorSchedule->is_available) == 1 ? 'selected' : '' }}>
                                        Available
                                    </option>

                                    <option value="0"
                                        {{ old('is_available', $doctorSchedule->is_available) == 0 ? 'selected' : '' }}>
                                        Not Available
                                    </option>

                                </select>

                            </div>

                            <!-- Remarks -->
                            <div class="col-md-12 mb-3">

                                <label>Remarks</label>

                                <textarea
                                    name="remarks"
                                    rows="3"
                                    class="form-control">{{ old('remarks', $doctorSchedule->remarks) }}</textarea>

                            </div>

                        </div>

                        <div class="text-end">

                            <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update Schedule
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
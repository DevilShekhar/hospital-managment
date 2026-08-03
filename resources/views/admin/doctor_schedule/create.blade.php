@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Create Doctor Schedule</h4>

            <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('doctor-schedules.store') }}" method="POST">

                @csrf

                <div class="row">

                    <!-- Doctor -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Doctor
                            <span class="text-danger">*</span>
                        </label>

                        <select name="doctor_id" class="form-control" required>

                            <option value="">Select Doctor</option>

                            @foreach($doctors as $doctor)

                                <option value="{{ $doctor->id }}">

                                    Dr.
                                    {{ $doctor->first_name }}
                                    {{ $doctor->last_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Department -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Department
                        </label>

                        <select name="department_id" class="form-control">

                            <option value="">Select Department</option>

                            @foreach($departments as $department)

                                <option value="{{ $department->id }}">

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
                            required>

                    </div>

                    <!-- Day -->
                    <div class="col-md-6 mb-3">

                        <label>Day</label>

                        <select
                            name="day_of_week"
                            class="form-control">

                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>

                        </select>

                    </div>

                    <!-- Start Time -->
                    <div class="col-md-6 mb-3">

                        <label>Start Time</label>

                        <input
                            type="time"
                            name="start_time"
                            class="form-control">

                    </div>

                    <!-- End Time -->
                    <div class="col-md-6 mb-3">

                        <label>End Time</label>

                        <input
                            type="time"
                            name="end_time"
                            class="form-control">

                    </div>

                    <!-- Time Per Patient -->
                    <div class="col-md-6 mb-3">

                        <label>Time Per Patient</label>

                        <select
                            name="slot_duration"
                            class="form-control">

                            <option value="10">10 Minutes</option>
                            <option value="15">15 Minutes</option>
                            <option value="20">20 Minutes</option>
                            <option value="30">30 Minutes</option>

                        </select>

                    </div>

                    <!-- Maximum Patients -->
                    <div class="col-md-6 mb-3">

                        <label>Maximum Patients</label>

                        <input
                            type="number"
                            name="max_patients"
                            class="form-control">

                    </div>

                    <!-- Room -->
                    <div class="col-md-6 mb-3">

                        <label>Room Number</label>

                        <input
                            type="text"
                            name="room_no"
                            class="form-control">

                    </div>

                    <!-- Fee -->
                    <div class="col-md-6 mb-3">

                        <label>Consultation Fee</label>

                        <input
                            type="number"
                            name="consultation_fee"
                            class="form-control">

                    </div>

                    <!-- Availability -->
                    <div class="col-md-6 mb-3">

                        <label>Availability</label>

                        <select
                            name="is_available"
                            class="form-control">

                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>

                    </div>

                    <!-- Remarks -->
                    <div class="col-md-6 mb-3">

                        <label>Remarks</label>

                        <textarea
                            name="remarks"
                            rows="3"
                            class="form-control"></textarea>

                    </div>

                </div>

                <div class="text-end">

                    <button
                        type="reset"
                        class="btn btn-warning">
                        Reset
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Save Schedule
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit Doctor Schedule</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('doctor-schedules.index') }}">Doctor Schedules</a></li>
                <li class="breadcrumb-item active">Edit Schedule</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Update Schedule Details</h4>
                <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('doctor-schedules.update', $doctorSchedule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Doctor Select -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Doctor <span class="text-danger">*</span></label>
                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                @php
                                    $docName = $doctor->first_name ? ($doctor->first_name . ' ' . ($doctor->last_name ?? '')) : ($doctor->name ?? 'Doctor');
                                @endphp
                                <option value="{{ $doctor->id }}"
                                        data-department="{{ $doctor->department_id }}"
                                        {{ old('doctor_id', $doctorSchedule->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $docName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department Select -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $doctorSchedule->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name ?? $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Schedule Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Schedule Date <span class="text-danger">*</span></label>
                        <input type="date"
                               name="schedule_date"
                               id="schedule_date"
                               class="form-control"
                               value="{{ old('schedule_date', $doctorSchedule->schedule_date) }}"
                               required>
                    </div>

                    <!-- Day of Week -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Day <span class="text-danger">*</span></label>
                        <select name="day_of_week" id="day_of_week" class="form-control" required>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <option value="{{ $day }}" {{ old('day_of_week', $doctorSchedule->day_of_week) == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="time"
                               name="start_time"
                               class="form-control"
                               value="{{ old('start_time', $doctorSchedule->start_time) }}"
                               required>
                    </div>

                    <!-- End Time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Time <span class="text-danger">*</span></label>
                        <input type="time"
                               name="end_time"
                               class="form-control"
                               value="{{ old('end_time', $doctorSchedule->end_time) }}"
                               required>
                    </div>

                    <!-- Slot Duration -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slot Duration (Minutes)</label>
                        <select name="slot_duration" class="form-control">
                            <option value="10" {{ old('slot_duration', $doctorSchedule->slot_duration) == 10 ? 'selected' : '' }}>10 Minutes</option>
                            <option value="15" {{ old('slot_duration', $doctorSchedule->slot_duration) == 15 ? 'selected' : '' }}>15 Minutes</option>
                            <option value="20" {{ old('slot_duration', $doctorSchedule->slot_duration) == 20 ? 'selected' : '' }}>20 Minutes</option>
                            <option value="30" {{ old('slot_duration', $doctorSchedule->slot_duration) == 30 ? 'selected' : '' }}>30 Minutes</option>
                        </select>
                    </div>

                    <!-- Max Patients -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Maximum Patients</label>
                        <input type="number"
                               name="max_patients"
                               class="form-control"
                               value="{{ old('max_patients', $doctorSchedule->max_patients) }}">
                    </div>

                    <!-- Room Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text"
                               name="room_no"
                               class="form-control"
                               value="{{ old('room_no', $doctorSchedule->room_no) }}">
                    </div>

                    <!-- Consultation Fee -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Consultation Fee (₹)</label>
                        <input type="number"
                               step="0.01"
                               name="consultation_fee"
                               class="form-control"
                               value="{{ old('consultation_fee', $doctorSchedule->consultation_fee) }}">
                    </div>

                    <!-- Availability Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Availability</label>
                        <select name="is_available" class="form-control">
                            <option value="1" {{ old('is_available', $doctorSchedule->is_available) == 1 ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ old('is_available', $doctorSchedule->is_available) == 0 ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>

                    <!-- System Status (Status 0 or 1) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">System Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ old('status', $doctorSchedule->status) == 1 ? 'selected' : '' }}>Active (1)</option>
                            <option value="0" {{ old('status', $doctorSchedule->status) == 0 ? 'selected' : '' }}>Inactive (0)</option>
                        </select>
                    </div>

                    <!-- Remarks -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" rows="2" class="form-control">{{ old('remarks', $doctorSchedule->remarks) }}</textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <a href="{{ route('doctor-schedules.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Schedule
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Function to calculate and update Day based on Date
    function autoSelectDay(dateString) {
        if (!dateString) return;

        // Split YYYY-MM-DD to avoid UTC timezone offset issues
        var parts = dateString.split('-');
        if (parts.length === 3) {
            var year = parseInt(parts[0], 10);
            var month = parseInt(parts[1], 10) - 1; // Months are 0-indexed in JS
            var day = parseInt(parts[2], 10);

            var localDate = new Date(year, month, day);
            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayName = days[localDate.getDay()];

            // Set the calculated day in dropdown
            $('#day_of_week').val(dayName);
        }
    }

    // 1. Trigger when user changes the schedule date
    $('#schedule_date').on('change', function() {
        autoSelectDay($(this).val());
    });

    // 2. Trigger on page load if date is already pre-filled
    if ($('#schedule_date').val()) {
        autoSelectDay($('#schedule_date').val());
    }

    // Auto-select Department when Doctor is chosen
    $('#doctor_id').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var doctorDept = selectedOption.data('department');
        if (doctorDept) {
            $('#department_id').val(doctorDept);
        }
    });

});
</script>
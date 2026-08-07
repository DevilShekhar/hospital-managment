@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit Appointment</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Appointments</a></li>
                <li class="breadcrumb-item active">Edit Appointment</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Update Appointment Details</h4>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Select Existing Patient -->
                    <div class="col-md-12 mb-3 bg-light p-3 rounded">
                        <label class="form-label font-weight-bold">Select Existing Patient (Optional)</label>
                        <select class="form-control" id="select_patient">
                            <option value="">-- Choose Existing Patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" 
                                        data-name="{{ $patient->first_name }} {{ $patient->last_name }}"
                                        data-phone="{{ $patient->phone }}"
                                        {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->patient_id }} - {{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->phone }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="patient_id" id="patient_id" value="{{ old('patient_id', $appointment->patient_id) }}">

                    <!-- Appointment No -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Appointment No</label>
                        <input type="text"
                               class="form-control"
                               name="appointment_no"
                               value="{{ $appointment->appointment_no }}"
                               readonly>
                    </div>

                    <!-- Appointment Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
                        <input type="date"
                               class="form-control @error('appointment_date') is-invalid @enderror"
                               name="appointment_date"
                               value="{{ old('appointment_date', $appointment->appointment_date) }}"
                               required>
                        @error('appointment_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Appointment Time -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Appointment Time <span class="text-danger">*</span></label>
                        <input type="time"
                               class="form-control @error('appointment_time') is-invalid @enderror"
                               name="appointment_time"
                               value="{{ old('appointment_time', $appointment->appointment_time) }}"
                               required>
                        @error('appointment_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $appointment->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name ?? $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Specialist -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Specialist</label>
                        <select name="specialist_id" id="specialist_id" class="form-control">
                            <option value="">Select Specialist</option>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}" {{ old('specialist_id', $appointment->specialist_id) == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Doctor -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Doctor <span class="text-danger">*</span></label>
                        <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                @php
                                    $docName = $doctor->first_name ? ($doctor->first_name . ' ' . ($doctor->last_name ?? '')) : ($doctor->name ?? 'Doctor');
                                @endphp
                                <option value="{{ $doctor->id }}"
                                        data-department="{{ $doctor->department_id }}"
                                        {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $docName }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('mobile_number') is-invalid @enderror"
                               id="mobile_number"
                               name="mobile_number"
                               value="{{ old('mobile_number', $appointment->mobile_number) }}"
                               placeholder="Enter 10-digit Mobile Number"
                               maxlength="10"
                               required>
                        @error('mobile_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Patient Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Patient Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('patient_name') is-invalid @enderror"
                               id="patient_name"
                               name="patient_name"
                               value="{{ old('patient_name', $appointment->patient_name) }}"
                               placeholder="Enter Patient Name"
                               required>
                        @error('patient_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Status Selection -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            Appointment Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="status">
                            <option value="Scheduled" {{ $appointment->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>

                    </div>

                    <!-- Visit Type -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Visit Type</label>
                        <select class="form-control" name="visit_type">
                            <option value="New Consultation" {{ old('visit_type', $appointment->visit_type) == 'New Consultation' ? 'selected' : '' }}>New Consultation</option>
                            <option value="Follow-up" {{ old('visit_type', $appointment->visit_type) == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                            <option value="Routine Checkup" {{ old('visit_type', $appointment->visit_type) == 'Routine Checkup' ? 'selected' : '' }}>Routine Checkup</option>
                            <option value="Emergency" {{ old('visit_type', $appointment->visit_type) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control" name="priority">
                            <option value="Low" {{ old('priority', $appointment->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Normal" {{ old('priority', $appointment->priority) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="High" {{ old('priority', $appointment->priority) == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Urgent" {{ old('priority', $appointment->priority) == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Record Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="is_active">
                            <option value="1" {{ $appointment->is_active == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $appointment->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>

                    </div>
                    <!-- Reason -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Reason for Visit</label>
                        <textarea class="form-control" rows="2" name="reason">{{ old('reason', $appointment->reason) }}</textarea>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" name="notes">{{ old('notes', $appointment->notes) }}</textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <a href="{{ route('appointments.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Appointment
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

    // Patient Dropdown Change Handler
    $('#select_patient').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var patientId = $(this).val();
        var name = selectedOption.data('name');
        var phone = selectedOption.data('phone');

        if (patientId) {
            $('#patient_id').val(patientId);
            $('#patient_name').val(name);
            $('#mobile_number').val(phone);
        }
    });

    // Filter Doctors based on Department
    $('#department_id').on('change', function() {
        var selectedDepartment = $(this).val();
        var doctorSelect = $('#doctor_id');

        doctorSelect.find('option').each(function() {
            var doctorDept = $(this).data('department');

            if ($(this).val() === "") {
                $(this).show();
            } else if (!selectedDepartment || doctorDept == selectedDepartment) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});F
</script>
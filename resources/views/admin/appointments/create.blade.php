@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Create Appointment</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Appointments</a></li>
                <li class="breadcrumb-item active">Create Appointment</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">New Appointment Registration</h4>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Appointment No -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Appointment No</label>
                        <input type="text"
                               class="form-control"
                               name="appointment_no"
                               value="{{ old('appointment_no', 'APT' . date('YmdHis')) }}"
                               readonly>
                    </div>

                    <!-- Appointment Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
                        <input type="date"
                               class="form-control @error('appointment_date') is-invalid @enderror"
                               name="appointment_date"
                               value="{{ old('appointment_date', date('Y-m-d')) }}"
                               min="{{ date('Y-m-d') }}"
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
                               value="{{ old('appointment_time') }}"
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
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name ?? $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Doctor -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Doctor <span class="text-danger">*</span></label>
                        <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                        data-department="{{ $doctor->department_id }}"
                                        data-specialization="{{ $doctor->specialization ?? 'General' }}"
                                        {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Specialist / Specialization -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Specialist</label>
                        <input type="text" 
                               class="form-control" 
                               id="specialization" 
                               name="specialization" 
                               value="{{ old('specialization') }}" 
                               placeholder="Doctor Specialization" 
                               readonly>
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('mobile_number') is-invalid @enderror"
                               id="mobile_number"
                               name="mobile_number"
                               value="{{ old('mobile_number') }}"
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
                               value="{{ old('patient_name') }}"
                               placeholder="Enter Patient Name"
                               required>
                        @error('patient_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Visit Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Visit Type</label>
                        <select class="form-control" name="visit_type">
                            <option value="New Consultation" {{ old('visit_type') == 'New Consultation' ? 'selected' : '' }}>New Consultation</option>
                            <option value="Follow-up" {{ old('visit_type') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                            <option value="Routine Checkup" {{ old('visit_type') == 'Routine Checkup' ? 'selected' : '' }}>Routine Checkup</option>
                            <option value="Emergency" {{ old('visit_type') == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control" name="priority">
                            <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Normal" {{ old('priority') == 'Normal' || !old('priority') ? 'selected' : '' }}>Normal</option>
                            <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Urgent" {{ old('priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <!-- Reason -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Reason for Visit</label>
                        <textarea class="form-control"
                                  rows="2"
                                  name="reason"
                                  placeholder="Enter reason for appointment">{{ old('reason') }}</textarea>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control"
                                  rows="2"
                                  name="notes"
                                  placeholder="Additional notes">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Appointment
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('department_id');
    const doctorSelect = document.getElementById('doctor_id');
    const specializationInput = document.getElementById('specialization');

   
    departmentSelect.addEventListener('change', function () {
        const selectedDepartment = this.value;

        Array.from(doctorSelect.options).forEach(function (option) {
            if (option.value === "") {
                option.hidden = false;
                return;
            }

            if (selectedDepartment === "" || option.dataset.department === selectedDepartment) {
                option.hidden = false;
            } else {
                option.hidden = true;
            }
        });

        doctorSelect.value = "";
        specializationInput.value = "";
    });

   
    doctorSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.value !== "") {
            specializationInput.value = selectedOption.dataset.specialization || 'General';
            
            if (!departmentSelect.value && selectedOption.dataset.department) {
                departmentSelect.value = selectedOption.dataset.department;
            }
        } else {
            specializationInput.value = "";
        }
    });
});
</script>
@endpush
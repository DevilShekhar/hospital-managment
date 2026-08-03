@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Create Appointment</h4>

                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body">

                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- Appointment No -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Appointment No</label>
                                <input type="text"
                                       class="form-control"
                                       name="appointment_no"
                                       value="APT{{ date('YmdHis') }}"
                                       readonly>
                            </div>

                            <!-- Appointment Date -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Appointment Date <span class="text-danger">*</span></label>

                                <input type="date"
                                       class="form-control"
                                       name="appointment_date"
                                       required>
                            </div>

                            <!-- Appointment Time -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Appointment Time <span class="text-danger">*</span></label>

                                <input type="time"
                                       class="form-control"
                                       name="appointment_time"
                                       required>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department</label>

                                <select class="form-control" name="department_id">
                                    <option value="">Select Department</option>

                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->department_name ?? $department->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- Doctor -->
                            <!-- Doctor -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Doctor</label>

                                <select class="form-control" id="doctor_id" name="doctor_id">
                                    <option value="">Select Doctor</option>

                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"
                                                data-specialization="{{ $doctor->specialization }}">
                                            Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Specialist -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specialist</label>

                                <select class="form-control" id="specialization" name="specialization">
                                    <option value="">Select Specialist</option>

                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->specialization }}">
                                            {{ $specialization->specialization }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Patient Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Patient Name</label>

                                <input type="text"
                                       class="form-control"
                                       name="patient_name"
                                       placeholder="Enter Patient Name">
                            </div>

                            <!-- Mobile -->
                           <div class="col-md-6 mb-3">
                                <label class="form-label">
                                     Mobile Number <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                        class="form-control @error('mobile_number') is-invalid @enderror"
                                        name="mobile_number"
                                        value="{{ old('mobile_number') }}"
                                        placeholder="Enter 10-digit Mobile Number"
                                        maxlength="10"
                                        required>

                                        @error('mobile_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                            </div>
                            
                            <!-- Visit Type -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Visit Type</label>

                                <select class="form-control" name="visit_type">
                                    <option>New Consultation</option>
                                    <option>Follow-up</option>
                                    <option>Routine Checkup</option>
                                    <option>Emergency</option>
                                </select>
                            </div>

                            <!-- Priority -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Priority</label>

                                <select class="form-control" name="priority">
                                    <option>Low</option>
                                    <option selected>Normal</option>
                                    <option>High</option>
                                    <option>Urgent</option>
                                </select>
                            </div>

                            

                            <!-- Reason -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Reason for Visit</label>

                                <textarea class="form-control"
                                          rows="3"
                                          name="reason"
                                          placeholder="Enter reason for appointment"></textarea>
                            </div>

                            <!-- Notes -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Notes</label>

                                <textarea class="form-control"
                                          rows="3"
                                          name="notes"
                                          placeholder="Additional notes"></textarea>
                            </div>

                        </div>

                        <div class="text-end mt-4">

                            <button type="reset" class="btn btn-warning">
                                Reset
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Save Appointment
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const specialization = document.getElementById('specialization');
    const doctor = document.getElementById('doctor_id');

    specialization.addEventListener('change', function () {

        const selected = this.value;

        Array.from(doctor.options).forEach(function(option) {

            if (option.value === "") {
                option.hidden = false;
                return;
            }

            option.hidden = selected !== "" &&
                            option.dataset.specialization !== selected;
        });

        doctor.value = "";
    });

});
</script>
@endsection
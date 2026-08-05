@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Add Patient</h4>
                        <p class="card-description">
                            Enter Patient Details
                        </p>
                    </div>

                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left mr-1"></i> Back
                    </a>
                </div>

                {{-- Validation Errors --}}
               

                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Patient ID -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Patient ID <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="patient_id"
                                   class="form-control @error('patient_id') is-invalid @enderror"
                                   value="{{ old('patient_id', 'PAT'.date('Ymd').rand(100,999)) }}"
                                   readonly>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}"
                                   placeholder="Enter First Name" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}"
                                   placeholder="Enter Last Name" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date"
                                   name="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}"
                                   placeholder="Enter Mobile Number" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="Enter Email Address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Blood Group -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" class="form-control @error('blood_group') is-invalid @enderror">
                                <option value="">Select</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                    <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                @endforeach
                            </select>
                            @error('blood_group')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Marital Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Marital Status</label>
                            <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                                <option value="">Select</option>
                                @foreach(['Single', 'Married', 'Divorced', 'Widowed'] as $status)
                                    <option value="{{ $status }}" {{ old('marital_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('marital_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dynamic Department Dropdown -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dynamic Doctor Dropdown -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" id="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required>
                                <option value="">Select Doctor</option>
                                {{-- Dependent options here --}}
                            </select>
                            @error('doctor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Full Address" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="City">
                        </div>

                        <!-- State -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state') }}" placeholder="State">
                        </div>

                        <!-- Country -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country') }}" placeholder="Country">
                        </div>

                        <!-- Pin Code -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">PIN Code</label>
                            <input type="text" name="pin_code" class="form-control" value="{{ old('pin_code') }}" placeholder="Pin Code">
                        </div>

                        <!-- Emergency Contact Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Emergency Contact Name <span class="text-danger">*</span></label>
                            <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror" value="{{ old('emergency_contact_name') }}" placeholder="Contact Person Name" required>
                            @error('emergency_contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Emergency Contact Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Emergency Contact Phone <span class="text-danger">*</span></label>
                            <input type="text" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror" value="{{ old('emergency_contact_phone') }}" placeholder="Contact Phone Number" required>
                            @error('emergency_contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Relation -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Relation</label>
                            <input type="text" name="relation" class="form-control" value="{{ old('relation') }}" placeholder="e.g. Father, Spouse">
                        </div>

                        <!-- Medical History -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Medical History</label>
                            <textarea name="medical_history" rows="3" class="form-control" placeholder="Brief Medical History">{{ old('medical_history') }}</textarea>
                        </div>

                        <!-- Allergies -->
                        <div class="col-md-12 mb-3">
                         <label class="form-label">Allergies</label>
                            <textarea name="allergies" rows="3" class="form-control" placeholder="Any Known Allergies">{{ old('allergies') }}</textarea>
                        </div>

                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save mr-1"></i> Save Patient
                        </button>

                        <a href="{{ route('patients.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    function loadDoctors(departmentId, selectedDoctorId = null) {
        let doctorDropdown = $('#doctor_id');

        if (departmentId) {
            doctorDropdown.html('<option value="">Loading Doctors...</option>');

            $.ajax({
                url: "{{ route('get.doctors.by.department') }}",
                type: "GET",
                data: { department_id: departmentId },
                dataType: "json",
                success: function(data) {
                    doctorDropdown.empty();
                    doctorDropdown.append('<option value="">Select Doctor</option>');

                    if (data && data.length > 0) {
                        $.each(data, function(key, value) {
                            
                            let doctorName = '';
                            if (value.first_name) {
                                doctorName = value.first_name + ' ' + (value.last_name || '');
                            } else {
                                doctorName = value.name || 'Doctor';
                            }

                            let selected = (selectedDoctorId && selectedDoctorId == value.id) ? 'selected' : '';
                            doctorDropdown.append('<option value="' + value.id + '" ' + selected + '>Dr. ' + doctorName + '</option>');
                        });
                    } else {
                        doctorDropdown.append('<option value="">No Doctors Found for this Department</option>');
                    }
                },
                error: function(xhr) {
                    console.error("AJAX Error: ", xhr.responseText);
                    doctorDropdown.empty().append('<option value="">Error loading doctors</option>');
                }
            });
        } else {
            doctorDropdown.empty().append('<option value="">Select Doctor</option>');
        }
    }

    $(document).on('change', '#department_id', function() {
        var departmentId = $(this).val();
        loadDoctors(departmentId);
    });

    
    var initialDepartment = $('#department_id').val();
    if (initialDepartment) {
        loadDoctors(initialDepartment, "{{ old('doctor_id') }}");
    }
});
</script>
@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Edit Patient</h4>
                        <p class="card-description">
                            Update Patient Details
                        </p>
                    </div>

                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Patient ID -->
                        <div class="col-md-6 mb-3">
                            <label>Patient ID</label>
                            <input type="text"
                                   name="patient_id"
                                   class="form-control"
                                   value="{{ old('patient_id', $patient->patient_id) }}">
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label>Department</label>

                            <select name="department_id" class="form-control">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $patient->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="col-md-6 mb-3">
                            <label>Doctor</label>

                            <select name="doctor_id" class="form-control">
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id', $patient->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label>First Name</label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   value="{{ old('first_name', $patient->first_name) }}">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label>Last Name</label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="{{ old('last_name', $patient->last_name) }}">
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $patient->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label>Date of Birth</label>
                            <input type="date"
                                   name="date_of_birth"
                                   class="form-control"
                                   value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone', $patient->phone) }}">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $patient->email) }}">
                        </div>

                        <!-- Blood Group -->
                        <div class="col-md-6 mb-3">
                            <label>Blood Group</label>
                            <input type="text"
                                   name="blood_group"
                                   class="form-control"
                                   value="{{ old('blood_group', $patient->blood_group) }}">
                        </div>
                        

                        
                        <!-- Emergency Contact Name -->
                        <div class="col-md-6 mb-3">
                            <label>Emergency Contact Name <span class="text-danger">*</span></label>
                            <input type="text"
                                name="emergency_contact_name"
                                class="form-control"
                                value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}">
                        </div>

                        <!-- Emergency Contact Phone -->
                        <div class="col-md-6 mb-3">
                            <label>Emergency Contact Phone <span class="text-danger">*</span></label>
                            <input type="text"
                                name="emergency_contact_phone"
                                class="form-control"
                                value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}">
                        </div>

                        <!-- City -->
                        <div class="col-md-6 mb-3">
                            <label>City</label>
                            <input type="text"
                                name="city"
                                class="form-control"
                                value="{{ old('city', $patient->city) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $patient->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $patient->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address', $patient->address) }}</textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Patient
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
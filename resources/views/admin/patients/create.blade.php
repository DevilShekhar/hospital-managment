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
                        Back
                    </a>
                </div>

                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Patient ID -->
                        <div class="col-md-6 mb-3">
                            <label>Patient ID <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="patient_id"
                                   class="form-control"
                                   value="{{ old('patient_id', 'PAT'.date('Ymd').rand(100,999)) }}"
                                   readonly>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   value="{{ old('first_name') }}">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="{{ old('last_name') }}">
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label>Date of Birth <span class="text-danger">*</span></label>
                            <input type="date"
                                   name="date_of_birth"
                                   class="form-control"
                                   value="{{ old('date_of_birth') }}">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone') }}">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}">
                        </div>

                        <!-- Blood Group -->
                        <div class="col-md-6 mb-3">
                            <label>Blood Group</label>
                            <select name="blood_group" class="form-control">
                                <option value="">Select</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>

                        <!-- Marital Status -->
                        <div class="col-md-6 mb-3">
                            <label>Marital Status</label>
                            <select name="marital_status" class="form-control">
                                <option value="">Select</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Divorced</option>
                                <option>Widowed</option>
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label>Department <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-control">
                                <option value="">Select Department</option>

                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="col-md-6 mb-3">
                            <label>Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-control">
                                <option value="">Select Doctor</option>

                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control">{{ old('address') }}</textarea>
                        </div>

                        <!-- City -->
                        <div class="col-md-3 mb-3">
                            <label>City</label>
                            <input type="text"
                                   name="city"
                                   class="form-control"
                                   value="{{ old('city') }}">
                        </div>

                        <!-- State -->
                        <div class="col-md-3 mb-3">
                            <label>State</label>
                            <input type="text"
                                   name="state"
                                   class="form-control"
                                   value="{{ old('state') }}">
                        </div>

                        <!-- Country -->
                        <div class="col-md-3 mb-3">
                            <label>Country</label>
                            <input type="text"
                                   name="country"
                                   class="form-control"
                                   value="{{ old('country') }}">
                        </div>

                        <!-- Pin Code -->
                        <div class="col-md-3 mb-3">
                            <label>PIN Code</label>
                            <input type="text"
                                   name="pin_code"
                                   class="form-control"
                                   value="{{ old('pin_code') }}">
                        </div>

                        <!-- Emergency Contact -->
                        <div class="col-md-6 mb-3">
                            <label>Emergency Contact Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="emergency_contact_name"
                                   class="form-control"
                                   value="{{ old('emergency_contact_name') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Emergency Contact Phone <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="emergency_contact_phone"
                                   class="form-control"
                                   value="{{ old('emergency_contact_phone') }}">
                        </div>

                        <!-- Relation -->
                        <div class="col-md-6 mb-3">
                            <label>Relation</label>
                            <input type="text"
                                   name="relation"
                                   class="form-control"
                                   value="{{ old('relation') }}">
                        </div>

                        <!-- Medical History -->
                        <div class="col-md-6 mb-3">
                            <label>Medical History</label>
                            <textarea name="medical_history"
                                      rows="3"
                                      class="form-control">{{ old('medical_history') }}</textarea>
                        </div>

                        <!-- Allergies -->
                        <div class="col-md-12 mb-3">
                            <label>Allergies</label>
                            <textarea name="allergies"
                                      rows="3"
                                      class="form-control">{{ old('allergies') }}</textarea>
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Save Patient
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
@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Create Medical Record</h4>
                        <p class="card-description">
                            Add a new medical record.
                        </p>
                    </div>

                    <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medical_records.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <!-- Medical Record Number -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Medical Record No <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="record_no"
                                   class="form-control"
                                   value="{{ old('record_no') }}"
                                   placeholder="MR-0001">
                        </div>

                        <!-- Visit Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Visit Date <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                   name="visit_date"
                                   class="form-control"
                                   value="{{ old('visit_date') }}">
                        </div>

                        <!-- Patient -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Patient <span class="text-danger">*</span>
                            </label>

                            <select name="patient_id" class="form-control">
                                <option value="">Select Patient</option>

                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->first_name }} {{ $patient->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Doctor <span class="text-danger">*</span>
                            </label>

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

                        <!-- Symptoms -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Symptoms <span class="text-danger">*</span>
                            </label>

                            <textarea name="symptoms"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Enter symptoms">{{ old('symptoms') }}</textarea>
                        </div>

                        <!-- Diagnosis -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Diagnosis <span class="text-danger">*</span>
                            </label>

                            <textarea name="diagnosis"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Enter diagnosis">{{ old('diagnosis') }}</textarea>
                        </div>

                        <!-- Prescription -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Prescription <span class="text-danger">*</span>
                            </label>

                            <textarea name="prescription"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Enter prescription">{{ old('prescription') }}</textarea>
                        </div>

                        <!-- Doctor Notes -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Doctor Notes
                            </label>

                            <textarea name="doctor_notes"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Additional notes">{{ old('doctor_notes') }}</textarea>
                        </div>

                        <!-- Follow-up Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Follow-up Date
                            </label>

                            <input type="date"
                                   name="follow_up_date"
                                   class="form-control"
                                   value="{{ old('follow_up_date') }}">
                        </div>

                        <!-- Status -->
                        <!-- Treatment Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Treatment Status <span class="text-danger">*</span>
                        </label>

                        <select name="treatment_status" class="form-control">

                            <option value="Registered"
                                {{ old('treatment_status') == 'Registered' ? 'selected' : '' }}>
                                Registered
                            </option>

                            <option value="Under Treatment"
                                {{ old('treatment_status') == 'Under Treatment' ? 'selected' : '' }}>
                                Under Treatment
                            </option>

                            <option value="Recovering"
                                {{ old('treatment_status') == 'Recovering' ? 'selected' : '' }}>
                                Recovering
                            </option>

                            <option value="Follow Up"
                                {{ old('treatment_status') == 'Follow Up' ? 'selected' : '' }}>
                                Follow Up
                            </option>

                            <option value="Discharged"
                                {{ old('treatment_status') == 'Discharged' ? 'selected' : '' }}>
                                Discharged
                            </option>

                            <option value="Cancelled"
                                {{ old('treatment_status') == 'Cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>
                    </div>

                    </div>

                    <div class="text-end">

                        <button type="reset" class="btn btn-light">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Medical Record
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
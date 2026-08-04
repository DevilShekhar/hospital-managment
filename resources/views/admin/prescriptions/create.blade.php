@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Create Prescription</h4>
                        <p class="card-description">
                            Add a new patient prescription.
                        </p>
                    </div>

                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('prescriptions.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <!-- Prescription No -->
                        <div class="col-md-6 mb-3">
                            <label>Prescription No <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="prescription_no"
                                   class="form-control"
                                   value="{{ old('prescription_no') }}"
                                   placeholder="PR-0001">
                        </div>

                        <!-- Prescription Date -->
                        <div class="col-md-6 mb-3">
                            <label>Prescription Date <span class="text-danger">*</span></label>

                            <input type="date"
                                   name="prescription_date"
                                   class="form-control"
                                   value="{{ old('prescription_date',date('Y-m-d')) }}">
                        </div>

                        <!-- Patient -->
                        <div class="col-md-6 mb-3">
                            <label>Patient <span class="text-danger">*</span></label>

                            <select name="patient_id" class="form-control">

                                <option value="">Select Patient</option>

                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        {{ old('patient_id')==$patient->id ? 'selected' : '' }}>

                                        {{ $patient->first_name }}
                                        {{ $patient->last_name }}

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
                                        {{ old('doctor_id')==$doctor->id ? 'selected' : '' }}>

                                        Dr. {{ $doctor->first_name }}
                                        {{ $doctor->last_name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Medical Record -->
                        <div class="col-md-6 mb-3">
                            <label>Medical Record</label>

                            <select name="medical_record_id" class="form-control">

                                <option value="">Select Medical Record</option>

                                @foreach($medicalRecords as $record)

                                    <option value="{{ $record->id }}">

                                        {{ $record->record_no }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <!-- Medicine -->
                        <div class="col-md-6 mb-3">
                            <label>Medicine Name <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="medicine_name"
                                   class="form-control"
                                   value="{{ old('medicine_name') }}"
                                   placeholder="Paracetamol 500mg">
                        </div>

                        <!-- Dosage -->
                        <div class="col-md-4 mb-3">
                            <label>Dosage</label>

                            <input type="text"
                                   name="dosage"
                                   class="form-control"
                                   value="{{ old('dosage') }}"
                                   placeholder="500 mg">
                        </div>

                        <!-- Frequency -->
                        <div class="col-md-4 mb-3">
                            <label>Frequency</label>

                            <select name="frequency" class="form-control">

                                <option value="">Select</option>

                                <option value="Once Daily">Once Daily</option>
                                <option value="Twice Daily">Twice Daily</option>
                                <option value="Three Times Daily">Three Times Daily</option>
                                <option value="SOS">SOS</option>

                            </select>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-4 mb-3">
                            <label>Duration</label>

                            <input type="text"
                                   name="duration"
                                   class="form-control"
                                   placeholder="5 Days"
                                   value="{{ old('duration') }}">
                        </div>

                        <!-- Food Timing -->
                        <div class="col-md-6 mb-3">
                            <label>Food Timing</label>

                            <select name="food_timing" class="form-control">

                                <option value="">Select</option>

                                <option value="Before Food">Before Food</option>
                                <option value="After Food">After Food</option>

                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6 mb-3">
                            <label>Quantity</label>

                            <input type="number"
                                   name="quantity"
                                   class="form-control"
                                   value="{{ old('quantity') }}">
                        </div>

                        <!-- Instructions -->
                        <div class="col-md-12 mb-3">
                            <label>Instructions</label>

                            <textarea name="instructions"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Take with water after meals">{{ old('instructions') }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="Active">Active</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>

                            </select>
                        </div>

                    </div>

                    <div class="text-end">

                        <button type="reset" class="btn btn-light">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Save Prescription
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
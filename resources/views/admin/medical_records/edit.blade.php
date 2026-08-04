@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Edit Medical Record</h4>

                    <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">
                        Back
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


                <form action="{{ route('medical_records.update',$medicalRecord->id) }}" method="POST">

                    @csrf
                    @method('PUT')


                    <div class="row">

                        {{-- Patient --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient</label>

                                <select name="patient_id" class="form-control">

                                    <option value="">Select Patient</option>

                                    @foreach($patients as $patient)

                                        <option value="{{ $patient->id }}"
                                            {{ $medicalRecord->patient_id == $patient->id ? 'selected' : '' }}>

                                            {{ $patient->first_name }}
                                            {{ $patient->last_name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>
                        </div>



                        {{-- Doctor --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Doctor</label>

                                <select name="doctor_id" class="form-control">

                                    <option value="">Select Doctor</option>

                                    @foreach($doctors as $doctor)

                                        <option value="{{ $doctor->id }}"
                                            {{ $medicalRecord->doctor_id == $doctor->id ? 'selected' : '' }}>

                                            Dr.
                                            {{ $doctor->first_name }}
                                            {{ $doctor->last_name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>



                        {{-- Record No --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Record Number</label>

                                <input type="text"
                                    name="record_no"
                                    class="form-control"
                                    value="{{ old('record_no',$medicalRecord->record_no) }}">

                            </div>

                        </div>



                        {{-- Visit Date --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Visit Date</label>

                                <input type="date"
                                    name="visit_date"
                                    class="form-control"
                                    value="{{ old('visit_date',$medicalRecord->visit_date) }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Symptoms</label>

                                <textarea name="symptoms"
                                        class="form-control"
                                        rows="3">{{ old('symptoms', $medicalRecord->symptoms) }}</textarea>
                            </div>
                        </div>

                        {{-- Diagnosis --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Diagnosis</label>

                                <textarea name="diagnosis"
                                    class="form-control"
                                    rows="3">{{ old('diagnosis',$medicalRecord->diagnosis) }}</textarea>

                            </div>

                        </div>



                        {{-- Prescription --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Prescription</label>

                                <textarea name="prescription"
                                class="form-control"
                                rows="3">{{ old('prescription', $medicalRecord->prescription) }}</textarea>
                            </div>

                        </div>



                        {{-- Notes --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Doctor Notes</label>

                                <textarea name="doctor_notes"
                                class="form-control"
                                rows="3">{{ old('doctor_notes', $medicalRecord->doctor_notes) }}</textarea>

                            </div>

                        </div>

                            {{-- Follow-up Date --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Follow-up Date</label>

                                <input type="date"
                                    name="follow_up_date"
                                    class="form-control"
                                    value="{{ old('follow_up_date', $medicalRecord->follow_up_date) }}">
                            </div>
                        </div>
                        {{-- Status --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>TreatmentStatus</label>

                                <select name="treatment_status" class="form-control">

                                    <option value="Registered"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Registered' ? 'selected' : '' }}>
                                        Registered
                                    </option>

                                    <option value="Under Treatment"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Under Treatment' ? 'selected' : '' }}>
                                        Under Treatment
                                    </option>

                                    <option value="Recovering"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Recovering' ? 'selected' : '' }}>
                                        Recovering
                                    </option>

                                    <option value="Follow Up"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Follow Up' ? 'selected' : '' }}>
                                        Follow Up
                                    </option>

                                    <option value="Discharged"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Discharged' ? 'selected' : '' }}>
                                        Discharged
                                    </option>

                                    <option value="Cancelled"
                                    {{ old('treatment_status', $medicalRecord->treatment_status) == 'Cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                        </div>


                    </div>


                    <button type="submit" class="btn btn-primary">
                        Update Medical Record
                    </button>


                </form>

            </div>
        </div>

    </div>
</div>


@endsection
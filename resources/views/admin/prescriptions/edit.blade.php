@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="card-title">Edit Prescription</h4>
                        <p class="card-description">
                            Update prescription details
                        </p>
                    </div>

                    <a href="{{ route('prescriptions.index') }}" 
                       class="btn btn-secondary">
                        Back
                    </a>

                </div>


                <form action="{{ route('prescriptions.update',$prescription->id) }}" 
                      method="POST">

                    @csrf
                    @method('PUT')


                    <div class="row">


                        {{-- Patient --}}
                        <div class="col-md-6 mb-3">

                            <label>Patient</label>

                            <select name="patient_id" class="form-control">

                                <option value="">
                                    Select Patient
                                </option>

                                @foreach($patients as $patient)

                                    <option value="{{ $patient->id }}"
                                        {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>

                                        {{ $patient->first_name }}
                                        {{ $patient->last_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>



                        {{-- Doctor --}}
                        <div class="col-md-6 mb-3">

                            <label>Doctor</label>

                            <select name="doctor_id" class="form-control">

                                <option value="">
                                    Select Doctor
                                </option>


                                @foreach($doctors as $doctor)

                                    <option value="{{ $doctor->id }}"
                                        {{ $prescription->doctor_id == $doctor->id ? 'selected' : '' }}>

                                        Dr.
                                        {{ $doctor->first_name }}
                                        {{ $doctor->last_name }}

                                    </option>

                                @endforeach


                            </select>

                        </div>



                        {{-- Medical Record --}}
                        <div class="col-md-6 mb-3">

                            <label>
                                Medical Record
                            </label>


                            <select name="medical_record_id" 
                                    class="form-control">


                                <option value="">
                                    Select Medical Record
                                </option>


                                @foreach($medicalRecords as $record)

                                    <option value="{{ $record->id }}"
                                        {{ $prescription->medical_record_id == $record->id ? 'selected' : '' }}>

                                        {{ $record->record_no }}

                                    </option>

                                @endforeach


                            </select>

                        </div>



                        {{-- Medicine --}}
                        <div class="col-md-6 mb-3">

                            <label>
                                Medicine
                            </label>

                            <input type="text"
                                   name="medicine"
                                   class="form-control"
                                   value="{{ old('medicine',$prescription->medicine) }}">

                        </div>



                        {{-- Dosage --}}
                        <div class="col-md-6 mb-3">

                            <label>
                                Dosage
                            </label>

                            <input type="text"
                                   name="dosage"
                                   class="form-control"
                                   value="{{ old('dosage',$prescription->dosage) }}">

                        </div>



                        {{-- Duration --}}
                        <div class="col-md-6 mb-3">

                            <label>
                                Duration
                            </label>

                            <input type="text"
                                   name="duration"
                                   class="form-control"
                                   value="{{ old('duration',$prescription->duration) }}">

                        </div>



                        {{-- Instructions --}}
                        <div class="col-md-12 mb-3">

                            <label>
                                Instructions
                            </label>

                            <textarea name="instructions"
                                      class="form-control"
                                      rows="4">{{ old('instructions',$prescription->instructions) }}</textarea>

                        </div>



                        {{-- Status --}}
                        <div class="col-md-6 mb-3">

                            <label>
                                Status
                            </label>


                            <select name="status" class="form-control">

                                <option value="1"
                                    {{ $prescription->status == 1 ? 'selected' : '' }}>
                                    Active
                                </option>


                                <option value="0"
                                    {{ $prescription->status == 0 ? 'selected' : '' }}>
                                    Deleted
                                </option>

                            </select>


                        </div>


                    </div>


                    <button type="submit" class="btn btn-primary">
                        Update Prescription
                    </button>


                </form>


            </div>

        </div>

    </div>
</div>


@endsection
@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Edit Queue</h4>
                        <p class="card-description">
                            Update Queue Details
                        </p>
                    </div>

                    <a href="{{ route('queues.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>

                <form action="{{ route('queues.update', $queue->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Doctor -->
                        <div class="col-md-6 mb-3">
                            <label>Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-control">
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $queue->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->first_name }} {{ $doctor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label>Department <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-control">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $queue->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Appointment -->
                        <div class="col-md-6 mb-3">
                            <label>Appointment</label>
                            <select name="appointment_id" class="form-control">
                                <option value="">Select Appointment</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}"
                                        {{ $queue->appointment_id == $appointment->id ? 'selected' : '' }}>
                                        Appointment #{{ $appointment->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Queue Number -->
                        <div class="col-md-6 mb-3">
                            <label>Queue Number</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $queue->queue_number }}"
                                   readonly>
                        </div>

                        <!-- Specialist -->
                        <div class="col-md-6 mb-3">
                            <label>Specialist <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="specialist"
                                   class="form-control"
                                   value="{{ old('specialist', $queue->specialist) }}">
                        </div>

                        <!-- Visit Date -->
                        <div class="col-md-6 mb-3">
                            <label>Visit Date <span class="text-danger">*</span></label>
                            <input type="date"
                                   name="visit_date"
                                   class="form-control"
                                   value="{{ old('visit_date', $queue->visit_date) }}">
                        </div>

                        <!-- Priority -->
                        <div class="col-md-6 mb-3">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <option value="Normal" {{ $queue->priority == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Urgent" {{ $queue->priority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="Emergency" {{ $queue->priority == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                            </select>
                        </div>

                        <!-- Remarks -->
                        <div class="col-md-12 mb-3">
                            <label>Remarks</label>
                            <textarea name="remarks"
                                      rows="4"
                                      class="form-control">{{ old('remarks', $queue->remarks) }}</textarea>
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            Update Queue
                        </button>

                        <a href="{{ route('queues.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
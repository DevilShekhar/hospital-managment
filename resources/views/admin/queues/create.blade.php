@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Create Queue</h4>
                        <p class="card-description">
                            Add New Patient Queue
                        </p>
                    </div>

                    <a href="{{ route('queues.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>

                <form action="{{ route('queues.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Patient</label>
                            <select name="patient_id" class="form-control">
                                <option value="">Select Patient</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Doctor</label>
                            <select name="doctor_id" class="form-control">
                                <option value="">Select Doctor</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Specialist</label>
                            <input type="text"
                                   name="specialist"
                                   class="form-control"
                                   placeholder="Enter Specialist">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Department</label>
                            <select name="department_id" class="form-control">
                                <option value="">Select Department</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Appointment</label>
                            <select name="appointment_id" class="form-control">
                                <option value="">Select Appointment</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Queue Number</label>
                            <input type="text"
                                   name="queue_number"
                                   class="form-control"
                                   value="{{ 'Q'.date('Ymd').rand(100,999) }}"
                                   readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Visit Date</label>
                            <input type="date"
                                   name="visit_date"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Emergency">Emergency</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Remarks</label>
                            <textarea
                                name="remarks"
                                rows="4"
                                class="form-control"
                                placeholder="Remarks (Optional)"></textarea>
                        </div>

                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary">
                            Save Queue
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
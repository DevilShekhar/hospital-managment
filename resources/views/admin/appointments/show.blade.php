@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="card-title mb-1">Appointment Details</h4>
            <p class="card-description mb-0">
                View appointment information.
            </p>
        </div>

        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label><strong>Appointment No</strong></label>
                    <p>{{ $appointment->appointment_no }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Patient Name</strong></label>
                    <p>{{ $appointment->patient_name }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Mobile Number</strong></label>
                    <p>{{ $appointment->mobile_number }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Department</strong></label>
                    <p>{{ $appointment->department->name ?? '-' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Specialist</strong></label>
                    <p>{{ $appointment->specialist->name ?? '-' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Doctor</strong></label>
                    <p>
                        @if($appointment->doctor)
                            Dr.
                            {{ $appointment->doctor->first_name }}
                            {{ $appointment->doctor->last_name }}
                        @else
                            -
                        @endif
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Appointment Date</strong></label>
                    <p>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Appointment Time</strong></label>
                    <p>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Visit Type</strong></label>
                    <p>{{ $appointment->visit_type ?? '-' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Priority</strong></label>
                    <p>{{ $appointment->priority ?? '-' }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Appointment Status</strong></label>

                    @if($appointment->status == 'Scheduled')
                        <span class="badge badge-warning">Scheduled</span>

                    @elseif($appointment->status == 'Confirm' || $appointment->status == 'Confirmed')
                        <span class="badge badge-primary">Confirmed</span>

                    @elseif($appointment->status == 'completed' || $appointment->status == 'Completed')
                        <span class="badge badge-success">Completed</span>

                    @elseif($appointment->status == 'Cancelled')
                        <span class="badge badge-danger">Cancelled</span>

                    @else
                        <span class="badge badge-secondary">
                            {{ $appointment->status }}
                        </span>
                    @endif

                </div>

                <div class="col-md-6 mb-3">
                    <label><strong>Record Status</strong></label>

                    @if($appointment->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-warning">Inactive</span>
                    @endif

                </div>

                <div class="col-md-12 mb-3">
                    <label><strong>Reason</strong></label>
                    <p>{{ $appointment->reason ?? '-' }}</p>
                </div>

                <div class="col-md-12 mb-3">
                    <label><strong>Notes</strong></label>
                    <p>{{ $appointment->notes ?? '-' }}</p>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
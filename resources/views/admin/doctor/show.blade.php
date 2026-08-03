@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Doctor Details</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('doctors.index') }}">Doctors</a></li>
                    <li class="breadcrumb-item active">View Details</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h4>
                    <div>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit Doctor
                        </a>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Doctor Employee ID:</label>
                        <p class="h6"><strong>{{ $doctor->employee_id ?? 'N/A' }}</strong></p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Full Name:</label>
                        <p class="h6">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Department:</label>
                        <p class="h6">{{ $doctor->department->name ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Specialization:</label>
                        <p class="h6">{{ $doctor->doctor->specialization ?? 'General' }}</p>
                    </div>

                    

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Email Address:</label>
                        <p class="h6">{{ $doctor->email }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Mobile Number:</label>
                        <p class="h6">{{ $doctor->mobile ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold text-muted">Status:</label>
                        <div>
                            @if($doctor->status == '1' || $doctor->status == 1)
                                <span class="status-pill status-active">
                                    <span class="dot"></span> Active
                                </span>
                            @else
                                <span class="status-pill status-inactive">
                                    <span class="dot"></span> Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
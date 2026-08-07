@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Doctor Profile Details</h4>
            <div>
                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm">Edit Doctor</a>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center border-right">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;" alt="Profile Photo">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px; font-size: 36px;">
                            {{ strtoupper(substr($doctor->first_name, 0, 1)) }}
                        </div>
                    @endif

                    <h5>{{ $doctor->first_name }} {{ $doctor->last_name }}</h5>
                    <p class="text-muted mb-1">{{ $doctor->employee_id ?? 'No Employee ID' }}</p>

                    @foreach($doctor->roles as $role)
                        <span class="badge badge-info">{{ $role->name }}</span>
                    @endforeach

                    <div class="mt-3">
                        @if($doctor->status == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-9">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 30%;">Full Name</th>
                            <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $doctor->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $doctor->mobile ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $doctor->department->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Specialization</th>
                            <td>{{ $doctor->specialist->name ?? ($doctor->specialization ?? 'General') }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $doctor->gender ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $doctor->dob ? \Carbon\Carbon::parse($doctor->dob)->format('d M Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $doctor->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>City / State / Pincode</th>
                            <td>
                                {{ $doctor->city ?? '' }} {{ $doctor->state ? ', ' . $doctor->state : '' }} {{ $doctor->pincode ? '- ' . $doctor->pincode : '' }}
                                @if(!$doctor->city && !$doctor->state && !$doctor->pincode) N/A @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $doctor->created_at ? $doctor->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
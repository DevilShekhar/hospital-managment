@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>User Profile Details</h4>
            <div>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit User</a>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center border-right">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;" alt="Profile Photo">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px; font-size: 36px;">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <p class="text-muted mb-1">{{ $user->employee_id ?? 'No Employee ID' }}</p>
                    
                    @foreach($user->roles as $role)
                        <span class="badge badge-info">{{ $role->name }}</span>
                    @endforeach

                    <div class="mt-3">
                        @if($user->status == 1)
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
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $user->mobile ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $user->department->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $user->gender ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>City / State / Pincode</th>
                            <td>
                                {{ $user->city ?? '' }} {{ $user->state ? ', ' . $user->state : '' }} {{ $user->pincode ? '- ' . $user->pincode : '' }}
                                @if(!$user->city && !$user->state && !$user->pincode) N/A @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
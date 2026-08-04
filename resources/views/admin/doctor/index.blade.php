@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="page-title">Doctor Management</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Doctor List</li>
                </ol>
            </nav>
        </div>

        {{-- Main Card --}}
        <div class="card">
            <div class="card-body">

                {{-- Header Action Section --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Hospital Doctors</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Add Doctor
                    </a>
                </div>

                {{-- Table Section with Theme's DataTables ID & Classes --}}
                <div class="table-responsive">
                    <table id="order-listing" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Doctor ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Specialization</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fee</th>
                                <th width="100">Status</th>
                                <th width="140">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $doctor->employee_id ?? 'N/A' }}</strong>
                                    </td>
                                    <td>
                                        Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                    </td>
                                    <td>{{ $doctor->department->name ?? '-' }}</td>
                                    
                                    {{-- Specialist Relationship Dynamic Output --}}
                                    <td>
                                        @if(isset($doctor->specialist))
                                            <span class="badge bg-soft-info text-info">
                                                {{ $doctor->specialist->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">{{ $doctor->specialization ?? 'General' }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->mobile ?? $doctor->phone ?? 'N/A' }}</td>
                                    <td>{{ $doctor->consultation_fee ? '$' . $doctor->consultation_fee : 'N/A' }}</td>
                                    <td>
                                        @if($doctor->status == '1' || $doctor->status == 1 || strtolower((string)$doctor->status) == 'active')
                                            <span class="status-pill status-active">
                                                <span class="dot"></span> Active
                                            </span>
                                        @else
                                            <span class="status-pill status-inactive">
                                                <span class="dot"></span> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            {{-- Show Button --}}
                                            <a href="{{ route('users.show', $doctor->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- Edit Button --}}
                                            <a href="{{ route('users.edit', $doctor->id) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- SweetAlert Delete Form --}}
                                            <form action="{{ route('users.destroy', $doctor->id) }}" method="POST"
                                                  id="delete-form-{{ $doctor->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger"
                                                        title="Delete"
                                                        onclick="confirmDelete({{ $doctor->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">
                                        No Doctors Found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection


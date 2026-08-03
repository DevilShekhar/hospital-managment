@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Doctor List</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Doctors
                </li>
                
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">

                {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                     <h4 class="card-title">Hospital Doctors</h4>
                    <a href="{{ route('doctors.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Add Doctor
                    </a>
                </div>



                {{-- Search Filter Form --}}
                <form method="GET" action="{{ route('doctors.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search Doctor..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search mr-1"></i> Search
                        </button>
                    </div>
                </form>

                {{-- Table Section --}}
                <div class="table-responsive">
                    <table id="order-listing" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Doctor ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th width="100">Status</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration + ($doctors->currentPage() - 1) * $doctors->perPage() }}</td>
                                    <td>
                                        <strong>{{ $doctor->employee_id ?? 'N/A' }}</strong>
                                    </td>
                                    <td>
                                        Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                    </td>
                                    <td>{{ $doctor->department->name ?? '-' }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->mobile ?? 'N/A' }}</td>
                                    <td>
                                        @if($doctor->status == '1' || $doctor->status == 1)
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
                                            <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Show
                                            </a>

                                            {{-- Edit Button --}}
                                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- SweetAlert Delete Form --}}
                                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                                id="delete-form-{{ $doctor->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete({{ $doctor->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        No Doctors Found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $doctors->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
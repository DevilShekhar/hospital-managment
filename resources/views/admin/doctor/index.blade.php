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

            <div class="row mb-3">

                <div class="col-md-6">
                    <h4 class="card-title">Doctor Management</h4>
                </div>

                <div class="col-md-6 text-end">

                    <a href="{{ route('doctors.create') }}" class="btn btn-primary">
                        Add Doctor
                    </a>

                </div>

            </div>

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            <form method="GET" action="{{ route('doctors.index') }}" class="mb-3">

                <div class="input-group">

                    <input type="text"
                           class="form-control"
                           name="search"
                           placeholder="Search Doctor..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary">
                        Search
                    </button>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                    <tr>

                        <th>#</th>

                        <th>Doctor ID</th>

                        <th>Name</th>

                        <th>Department</th>

                        <th>Specialization</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Fee</th>

                        <th>Status</th>

                        <th width="170">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($doctors as $doctor)

                        <tr>

                            <td>{{ $loop->iteration + ($doctors->currentPage()-1) * $doctors->perPage() }}</td>

                            <td>{{ $doctor->doctor_id }}</td>

                            <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>

                            <td>{{ $doctor->department->name ?? '-' }}</td>

                            <td>{{ $doctor->specialization }}</td>

                            <td>{{ $doctor->email }}</td>

                            <td>{{ $doctor->phone }}</td>

                            <td>{{ $doctor->consultation_fee }}</td>

                            <td>

                                @if($doctor->status=='Active')

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('doctors.edit',$doctor->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('doctors.destroy',$doctor->id) }}"
                                      method="POST"
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this doctor?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="text-center">

                                No Doctors Found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $doctors->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
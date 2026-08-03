@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title mb-1">Appointment Management</h4>
                        <p class="card-description mb-0">
                            Manage all patient appointments.
                        </p>
                    </div>

                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                        + Create Appointment
                    </a>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('appointments.index') }}" class="row mb-3">
                    <div class="col-md-5 d-flex gap-2">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search Patient / Mobile / Appointment No"
                               value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            Search
                        </button>

                        @if(request('search'))
                            <a href="{{ route('appointments.index') }}" class="btn btn-light btn-sm px-3">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="thead-light">
                            <tr>
                                <th width="50">#</th>
                                <th>Appointment No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>Specialist</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th width="170">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($appointments as $appointment)

                            <tr>

                                <td>
                                    {{ $loop->iteration + ($appointments->currentPage()-1) * $appointments->perPage() }}
                                </td>

                                <td>{{ $appointment->appointment_no }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </td>

                                <td>{{ $appointment->patient_name }}</td>

                                <td>{{ $appointment->mobile_number }}</td>

                                <td>
                                    {{ $appointment->department->department_name ?? '-' }}
                                </td>
                                
                                <td>
                                    {{ $appointment->doctor->specialization ?? '-' }}
                                </td>
                                <td>
                                    Dr.
                                    {{ $appointment->doctor->first_name ?? '' }}
                                    {{ $appointment->doctor->last_name ?? '' }}
                                </td>

                                <td>

                                    @switch($appointment->status)

                                        @case('Scheduled')
                                            <span class="badge badge-warning">Scheduled</span>
                                            @break

                                        @case('Confirmed')
                                            <span class="badge badge-info">Confirmed</span>
                                            @break

                                        @case('Completed')
                                            <span class="badge badge-success">Completed</span>
                                            @break

                                        @case('Cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                            @break

                                        @case('Checked In')
                                            <span class="badge badge-primary">Checked In</span>
                                            @break

                                        @default
                                            <span class="badge badge-secondary">
                                                {{ $appointment->status }}
                                            </span>

                                    @endswitch

                                </td>

                                <td>

                                    <a href="{{ route('appointments.edit',$appointment->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('appointments.destroy',$appointment->id) }}"
                                          method="POST"
                                          id="delete-appointment-{{ $appointment->id }}"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $appointment->id }})">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="11" class="text-center py-4 text-muted">
                                    No appointments found.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $appointments->appends(request()->query())->links() }}
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
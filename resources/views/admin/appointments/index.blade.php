@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="card-title mb-1">Appointment Management</h4>
            <p class="card-description mb-0">Manage all patient appointments.</p>
        </div>

        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
            + Create Appointment
        </a>
    </div>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('appointments.index') }}" class="row mb-3">
        <div class="col-md-5 d-flex gap-2">
            <input type="text"
                name="search"
                class="form-control"
                placeholder="Search Patient / Mobile / Appointment No" value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary btn-sm px-3">Search</button>

            @if(request('search'))
                <a href="{{ route('appointments.index') }}" class="btn btn-light btn-sm px-3">Reset</a>
            @endif
        </div>
    </form>
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
                    <th>Appointment Status</th>
                    <th>Record Status</th>
                    <th width="250">Action</th>
                </tr>
            </thead>
            <tbody>

            @forelse($appointments as $appointment)

                <tr>
                    <td>{{ $loop->iteration + ($appointments->currentPage() - 1) * $appointments->perPage() }}
                    </td>


                    <td>
                        <strong>
                            {{ $appointment->appointment_no ?? 'APT'.$appointment->id }}
                        </strong>
                    </td>

                    <td>

                        {{ $appointment->appointment_date 
                            ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y')
                            : '-' 
                        }}

                    </td>

                    <td>

                        {{ $appointment->appointment_time 
                            ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A')
                            : '-' 
                        }}
                    </td>
                    <td>{{ $appointment->patient_name ?? '-' }}
                    </td>

                    <td>
                        {{ $appointment->mobile_number ?? '-' }}
                    </td>

                    <td>
                        {{ $appointment->department->name 
                            ?? $appointment->department->department_name 
                            ?? '-' }}
                    </td>
                    <td>
                        {{ $appointment->specialist->name ?? '-' }}
                    </td>

                    <td>
                        @if($appointment->doctor)
                            Dr.
                            {{ $appointment->doctor->first_name 
                                ? $appointment->doctor->first_name.' '.($appointment->doctor->last_name ?? '')
                                : $appointment->doctor->name 
                            }}
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        @if($appointment->status == 'Scheduled')
                            <span class="badge badge-warning">Scheduled</span>
                        @elseif($appointment->status == 'Confirmed' || $appointment->status == 'Confirm')
                            <span class="badge badge-primary">Confirmed</span>
                        @elseif($appointment->status == 'Completed' || $appointment->status == 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif($appointment->status == 'Cancelled')
                            <span class="badge badge-danger">Cancelled</span>
                        @else
                            <span class="badge badge-secondary">{{ $appointment->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($appointment->is_active == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-warning">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment->id) }}"
                            class="btn btn-info btn-sm">
                            View
                        </a>
                        {{-- Edit always visible --}}
                        <a href="{{ route('appointments.edit',$appointment->id) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        {{-- Delete only active records --}}
                       @if($appointment->is_active == 1)

                            <form action="{{ route('appointments.destroy',$appointment->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13"
                        class="text-center py-4 text-muted">
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
@endsection
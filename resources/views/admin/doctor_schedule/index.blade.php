@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title mb-1">Doctor Schedule</h4>
                        <p class="card-description mb-0">Manage Doctor Schedules</p>
                    </div>

                    <a href="{{ route('doctor-schedules.create') }}" class="btn btn-primary">
                        + Create Schedule
                    </a>
                </div>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('doctor-schedules.index') }}" class="row mb-3">
                    <div class="col-md-5 d-flex gap-2">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search Doctor / Department / Date"
                               value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary btn-sm px-3">Search</button>

                        @if(request('search'))
                            <a href="{{ route('doctor-schedules.index') }}" class="btn btn-light btn-sm px-3">Reset</a>
                        @endif
                    </div>
                </form>

              

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="40">#</th>
                                <th>Doctor</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slot</th>
                                <th>Patients</th>
                                <th>Room</th>
                                <th>Availability</th> {{-- 👈 Column 1 --}}
                                <th>Status</th>       {{-- 👈 Column 2 --}}
                                <th width="140">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($doctorSchedules as $schedule)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($doctorSchedules->currentPage()-1) * $doctorSchedules->perPage() }}</td>

                                {{-- Doctor Name --}}
                                <td>
                                    <strong>
                                        @if($schedule->doctor)
                                            Dr. {{ $schedule->doctor->first_name ? ($schedule->doctor->first_name . ' ' . ($schedule->doctor->last_name ?? '')) : $schedule->doctor->name }}
                                        @else
                                            -
                                        @endif
                                    </strong>
                                </td>

                                {{-- Department --}}
                                <td>
                                    {{ $schedule->department->name ?? ($schedule->department->department_name ?? '-') }}
                                </td>

                                {{-- Date --}}
                                <td class="text-nowrap">
                                    {{ $schedule->schedule_date ? \Carbon\Carbon::parse($schedule->schedule_date)->format('d-m-Y') : '-' }}
                                </td>

                                {{-- Day --}}
                                <td>{{ $schedule->day_of_week ?? '-' }}</td>

                                {{-- Start & End Time --}}
                                <td class="text-nowrap">{{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') : '-' }}</td>
                                <td class="text-nowrap">{{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') : '-' }}</td>

                                {{-- Slot --}}
                                <td>{{ $schedule->slot_duration ? $schedule->slot_duration . ' mins' : '-' }}</td>

                                {{-- Max Patients --}}
                                <td class="text-center">{{ $schedule->max_patients ?? '-' }}</td>

                                {{-- Room --}}
                                <td>{{ $schedule->room_no ?? '-' }}</td>

                                {{-- Availability (is_available) --}}
                                <td class="text-center">
                                    @if($schedule->is_available)
                                        <span class="badge badge-success">Available</span>
                                    @else
                                        <span class="badge badge-danger">Not Available</span>
                                    @endif
                                </td>

                                {{-- System Status (status) --}}
                                <td class="text-center">
                                    @if($schedule->status == 1)
                                        <span class="badge badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>

                                {{-- Action Buttons --}}
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('doctor-schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('doctor-schedules.destroy', $schedule->id) }}" 
                                          method="POST" 
                                          class="d-inline-block" 
                                          onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-muted">No Schedule Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $doctorSchedules->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
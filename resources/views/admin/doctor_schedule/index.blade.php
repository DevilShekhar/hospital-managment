@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="card-title">Doctor Schedule</h4>
                        <p class="card-description">
                            Manage Doctor Schedules
                        </p>
                    </div>

                    <a href="{{ route('doctor-schedules.create') }}" class="btn btn-primary">
                        + Create Schedule
                    </a>

                </div>

                <form method="GET" action="{{ route('doctor-schedules.index') }}" class="row mb-3">

                    <div class="col-md-5 d-flex gap-2">

                        <input
                            type="text"
                            class="form-control"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search Doctor / Department / Date">

                        <button class="btn btn-primary">
                            Search
                        </button>

                        @if(request('search'))

                            <a href="{{ route('doctor-schedules.index') }}"
                               class="btn btn-secondary">

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

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Doctor</th>

                            <th>Department</th>

                            <th>Date</th>

                            <th>Day</th>

                            <th>Start Time</th>

                            <th>End Time</th>

                            <th>Slot</th>

                            <th>Patients</th>

                            <th>Room</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($doctorSchedules as $schedule)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($doctorSchedules->currentPage()-1) * $doctorSchedules->perPage() }}
                            </td>

                            <td>
                                Dr.
                                {{ $schedule->doctor->first_name ?? '' }}
                                {{ $schedule->doctor->last_name ?? '' }}
                            </td>

                            <td>
                                {{ $schedule->department->name ?? '-' }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($schedule->schedule_date)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $schedule->day_of_week }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                            </td>

                            <td>

                                {{ $schedule->slot_duration }} Minutes

                            </td>

                            <td>

                                {{ $schedule->max_patients }}

                            </td>

                            <td>

                                {{ $schedule->room_no }}

                            </td>

                            <td>

                                @if($schedule->is_available)

                                    <span class="badge badge-success">
                                        Available
                                    </span>

                                @else

                                    <span class="badge badge-danger">
                                        Not Available
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('doctor-schedules.edit',$schedule->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('doctor-schedules.destroy',$schedule->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Schedule?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="12" class="text-center">

                                No Schedule Found

                            </td>

                        </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $doctorSchedules->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Medical Records</h4>
                        <p class="card-description">
                            Manage all medical records.
                        </p>
                    </div>

                    <a href="{{ route('medical_records.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Medical Record
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Record No</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Visit Date</th>
                                <th>Treatment Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($medicalRecords as $key => $record)

                                <tr>

                                    <td>{{ $medicalRecords->firstItem() + $key }}</td>

                                    <td>{{ $record->record_no }}</td>

                                    <td>
                                        @if($record->patient)
                                            {{ $record->patient->first_name }}
                                            {{ $record->patient->last_name }}
                                        @else
                                            No Patient Assigned
                                        @endif
                                    </td>

                                    <td>
                                        @if($record->doctor)
                                            Dr.
                                            {{ $record->doctor->first_name }}
                                            {{ $record->doctor->last_name }}
                                        @else
                                            No Doctor Assigned
                                        @endif
                                    </td>

                                    <td>{{ $record->visit_date }}</td>

                                    <td>

                                        @if($record->treatment_status == 'Registered')

                                            <span class="badge badge-secondary">
                                                Registered
                                            </span>

                                        @elseif($record->treatment_status == 'Under Treatment')

                                            <span class="badge badge-warning">
                                                Under Treatment
                                            </span>

                                        @elseif($record->treatment_status == 'Recovering')

                                            <span class="badge badge-info">
                                                Recovering
                                            </span>

                                        @elseif($record->treatment_status == 'Follow Up')

                                            <span class="badge badge-primary">
                                                Follow Up
                                            </span>

                                        @elseif($record->treatment_status == 'Discharged')

                                            <span class="badge badge-success">
                                                Discharged
                                            </span>

                                        @else

                                            <span class="badge badge-danger">
                                                Cancelled
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('medical_records.edit',$record->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('medical_records.destroy',$record->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        No Medical Records Found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $medicalRecords->links() }}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
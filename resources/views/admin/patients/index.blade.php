@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Patient Management</h4>
                        <p class="card-description">
                            Manage Patients
                        </p>
                    </div>

                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Patient
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Department</th>
                                <th>Doctor</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Blood Group</th>
                                <th>City</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($patients as $key => $patient)

                            <tr>

                                <td>{{ $patients->firstItem() + $key }}</td>

                                <td>{{ $patient->patient_id }}</td>

                                <td>
                                    {{ $patient->first_name }}
                                    {{ $patient->last_name }}
                                </td>

                                <td>
                                    {{ $patient->department->name ?? '-' }}
                                </td>

                                <td>
                                    Dr.
                                    {{ $patient->doctor->first_name ?? '-' }}
                                    {{ $patient->doctor->last_name ?? '' }}
                                </td>

                                <td>{{ $patient->gender }}</td>

                                <td>{{ $patient->phone }}</td>

                                <td>{{ $patient->blood_group ?? '-' }}</td>

                                <td>{{ $patient->city ?? '-' }}</td>

                                <td>

                                    <a href="{{ route('patients.edit',$patient->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('patients.destroy',$patient->id) }}"
                                          method="POST"
                                          style="display:inline-block">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="10" class="text-center">
                                    No Patients Found.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $patients->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
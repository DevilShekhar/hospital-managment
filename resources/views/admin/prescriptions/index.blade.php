@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">


                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="card-title">
                            Prescription Management
                        </h4>

                        <p class="card-description">
                            Manage all prescriptions
                        </p>
                    </div>


                    <a href="{{ route('prescriptions.create') }}"
                       class="btn btn-primary">

                        Add Prescription

                    </a>

                </div>



                {{-- Search Bar --}}
                <form method="GET"
                      action="{{ route('prescriptions.index') }}"
                      class="mb-4">


                    <div class="row">


                        <div class="col-md-6">

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Search patient, doctor or medicine..."
                                   value="{{ request('search') }}">

                        </div>



                        <div class="col-md-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                Search

                            </button>

                        </div>



                        <div class="col-md-2">

                            <a href="{{ route('prescriptions.index') }}"
                               class="btn btn-secondary">

                                Reset

                            </a>

                        </div>


                    </div>


                </form>




                {{-- Table --}}
                <div class="table-responsive">


                    <table class="table table-bordered">


                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Patient</th>

                                <th>Doctor</th>

                                <th>Medical Record</th>

                                <th>Date</th>

                                <th>Actions</th>

                            </tr>

                        </thead>



                        <tbody>


                        @forelse($prescriptions as $key => $prescription)


                            <tr>


                                <td>
                                    {{ $prescriptions->firstItem() + $key }}
                                </td>



                                <td>

                                    {{ $prescription->patient->first_name ?? '' }}

                                    {{ $prescription->patient->last_name ?? '' }}

                                </td>



                                <td>

                                    Dr.

                                    {{ $prescription->doctor->first_name ?? '' }}

                                    {{ $prescription->doctor->last_name ?? '' }}

                                </td>



                                <td>

                                    {{ $prescription->medicalRecord->record_no ?? 'N/A' }}

                                </td>



                                <td>

                                    {{ $prescription->created_at->format('d-m-Y') }}

                                </td>



                                <td>


                                    <a href="{{ route('prescriptions.edit',$prescription->id) }}"
                                       class="btn btn-sm btn-warning">

                                        Edit

                                    </a>




                                    @if($prescription->status == 1)


                                        <form action="{{ route('prescriptions.destroy',$prescription->id) }}"
                                              method="POST"
                                              style="display:inline-block">


                                            @csrf

                                            @method('DELETE')


                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this prescription?')">

                                                Delete

                                            </button>


                                        </form>



                                    @else


                                        <span class="badge badge-danger">

                                            Deleted

                                        </span>


                                    @endif



                                </td>


                            </tr>



                        @empty


                            <tr>

                                <td colspan="6"
                                    class="text-center">

                                    No prescriptions found

                                </td>

                            </tr>


                        @endforelse



                        </tbody>


                    </table>


                </div>




                {{-- Pagination --}}

                <div class="mt-3">

                    {{ $prescriptions->links() }}

                </div>



            </div>

        </div>

    </div>
</div>


@endsection
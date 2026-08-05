@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="card-title">
                            Laboratory Test Details
                        </h4>

                        <p class="card-description">
                            View Laboratory Test Information
                        </p>
                    </div>


                    <div>

                        <a href="{{ route('laboratories.edit', $laboratory->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit Test
                        </a>

                        <a href="{{ route('laboratories.index') }}"
                           class="btn btn-secondary btn-sm">
                            Back to List
                        </a>

                    </div>

                </div>



                <div class="row">


                    <!-- Left Side Summary -->

                    <div class="col-md-4 border-right text-center  d-flex align-items-center justify-content-center">


                        <div class="mb-4 mt-5">


                            <h5 class="font-weight-bold mt-4">
                                {{ $laboratory->test_name }}
                            </h5>


                            <p class="text-muted mb-2">
                                {{ $laboratory->lab_code }}
                            </p>



                            <span class="badge badge-info px-3 py-2">

                                {{ $laboratory->category }}

                            </span>



                            <div class="mt-3">

                                @if($laboratory->status == 'Active')

                                    <span class="badge badge-success px-4 py-2">
                                        Active
                                    </span>

                                @else

                                    <span class="badge badge-danger px-4 py-2">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                        </div>


                    </div>




                    <!-- Right Side Details -->

                    <div class="col-md-8">


                        <table class="table table-striped">


                            <tr>

                                <th width="35%">
                                    Lab Code
                                </th>

                                <td>
                                    {{ $laboratory->lab_code }}
                                </td>

                            </tr>



                            <tr>

                                <th>
                                    Test Name
                                </th>

                                <td>
                                    {{ $laboratory->test_name }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Department
                                </th>

                                <td>
                                    {{ $laboratory->department->name ?? '-' }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Category
                                </th>

                                <td>
                                    {{ $laboratory->category }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Sample Type
                                </th>

                                <td>
                                    {{ $laboratory->sample_type }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Container Type
                                </th>

                                <td>
                                    {{ $laboratory->container_type }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Price
                                </th>

                                <td>
                                    ₹ {{ number_format($laboratory->price,2) }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Turnaround Time
                                </th>

                                <td>
                                    {{ $laboratory->turnaround_time }} Hours
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Fasting Required
                                </th>

                                <td>

                                    @if($laboratory->fasting_required)

                                        Yes

                                    @else

                                        No

                                    @endif

                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Home Collection
                                </th>

                                <td>

                                    @if($laboratory->home_collection)

                                        Available

                                    @else

                                        Not Available

                                    @endif

                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Description
                                </th>

                                <td>
                                    {{ $laboratory->description ?: 'N/A' }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Created At
                                </th>

                                <td>
                                    {{ $laboratory->created_at->format('d M Y h:i A') }}
                                </td>

                            </tr>




                            <tr>

                                <th>
                                    Updated At
                                </th>

                                <td>
                                    {{ $laboratory->updated_at->format('d M Y h:i A') }}
                                </td>

                            </tr>



                        </table>


                    </div>


                </div>


            </div>

        </div>

    </div>
</div>


@endsection
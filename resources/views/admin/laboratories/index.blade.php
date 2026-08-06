@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="page-header">
        <h3 class="page-title">Laboratory Management</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Laboratory Management</a>
                </li>
                <li class="breadcrumb-item active">
                    Laboratory Test List
                </li>
            </ol>
        </nav>
    </div>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="card-title">
                    Laboratory Test Management
                </h4>

                <a href="{{ route('laboratories.create') }}"
                    class="btn btn-primary">
                    + Add Laboratory Test
                </a>

            </div>

            

            <div class="table-responsive">

                <table id="order-listing"
                       class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Lab Code</th>
                            <th>Test Name</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Sample Type</th>
                            <th>Price</th>
                            <th>TAT</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($laboratories as $laboratory)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $laboratory->lab_code }}</td>

                            <td>{{ $laboratory->test_name }}</td>

                            <td>{{ optional($laboratory->department)->name ?? 'N/A' }}</td>

                            <td>{{ $laboratory->category }}</td>

                            <td>{{ $laboratory->sample_type }}</td>

                            <td>₹ {{ number_format($laboratory->price,2) }}</td>

                            <td>{{ $laboratory->turnaround_time }} Hr</td>
                            <td>
                                @if($laboratory->status == 1)
                                    <label class="badge badge-success">Active</label>
                                @else
                                    <label class="badge badge-danger">Inactive</label>
                                @endif
                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('laboratories.show',$laboratory->id) }}"
                                        class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('laboratories.edit',$laboratory->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                 @if($laboratory->status == 1)
                                    <form action="{{ route('laboratories.destroy', $laboratory->id) }}" 
                                        method="POST" 
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                            Delete
                                        </button>

                                    </form>
                                @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center">

                                No Laboratory Tests Found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
@endsection
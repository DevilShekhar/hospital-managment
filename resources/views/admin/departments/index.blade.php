@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Department Management</h3>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Hospital Departments</h4>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Add Department
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="order-listing" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="100">Status</th>
                                <th width="140">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $department->name }}</strong>
                                    </td>
                                    <td>
                                        {{ Str::limit($department->description, 50) ?? 'N/A' }}
                                    </td>
                                   <td>
                                        @if($department->status == 1)

                                            <span class="badge badge-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge badge-danger">
                                                Inactive
                                            </span>

                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('departments.edit', $department->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- SweetAlert2 Delete Form --}}
                                            @if($department->status == 1 && $department->deleted_at == null)

                                                <a href="{{ route('departments.destroy',$department->id) }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{$department->id}}').submit();"
                                                class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>

                                                <form id="delete-form-{{$department->id}}"
                                                    action="{{ route('departments.destroy',$department->id) }}"
                                                    method="POST"
                                                    style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No Departments Found.
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
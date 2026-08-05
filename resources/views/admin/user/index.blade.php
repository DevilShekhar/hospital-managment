@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">User Management</h3>
    
    </div>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Hospital Users</h4>
                <a href="{{ route('users.create') }}" class="btn btn-primary">+ Create User</a>
            </div>           
            
            <div class="table-responsive">
                <table id="order-listing" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th data-orderable="false">Employee ID</th>
                            <th data-orderable="false">Name</th>
                            <th data-orderable="false">Role</th>
                            <th data-orderable="false">Department</th>
                            <th data-orderable="false">Email</th>
                            <th data-orderable="false">Mobile</th>
                            <th data-orderable="false">Status</th>
                            <th data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ $user->employee_id ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </td>
                                <td>
                                    @forelse($user->roles as $role)
                                        <span class="badge bg-info">{{ $role->name }}</span>
                                    @empty
                                        <span class="badge bg-secondary">No Role</span>
                                    @endforelse
                                </td>
                                <td>
                                    {{ $user->department->name ?? 'N/A' }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile ?? 'N/A' }}</td>
                                <td>
                                    @if($user->status == 1)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                        @if($user->status == 1)
                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                method="POST"
                                                id="delete-form-{{ $user->id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete({{ $user->id }})">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <p class="text-muted mb-0">No users found in database.</p>
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
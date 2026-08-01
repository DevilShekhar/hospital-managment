@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title mb-1">Role Management</h4>
                        <p class="card-description mb-0">
                            Manage all roles in the hospital management system.
                        </p>
                    </div>

                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        + Create Role
                    </a>
                </div>

                {{-- Working Search Form --}}
                <form method="GET" action="{{ route('roles.index') }}" class="row mb-3">
                    <div class="col-md-4 d-flex gap-2">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Search Role..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm px-3">Search</button>
                        @if(request('search'))
                            <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm px-3">Reset</a>
                        @endif
                    </div>
                </form>

                {{-- Role Table --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Role Name</th>
                                <th width="180">Created Date</th>
                                <th width="170">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                                    <td>
                                        <strong>{{ $role->name }}</strong>
                                    </td>
                                    <td>
                                        {{ $role->created_at ? $role->created_at->format('d-m-Y') : 'N/A' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        {{-- Delete Form --}}
                                        <form action="{{ route('roles.destroy', $role->id) }}" 
                                              method="POST" 
                                              id="delete-role-{{ $role->id }}" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete({{ $role->id }})">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Working Pagination Links --}}
                <div class="mt-3 d-flex justify-content-end">
                    {{ $roles->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
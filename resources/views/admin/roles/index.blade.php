@extends('admin.layouts.app')

@section('content')

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

{{-- Search Form --}}
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
                <th width="150">Status</th>
                <th width="180">Created Date</th>
                <th width="200">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>
                    {{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}
                </td>
                <td>
                    <strong>{{ $role->name }}</strong>
                </td>
                <td>
                    @if($role->status == 1)
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
                    {{ $role->created_at ? $role->created_at->format('d-m-Y') : 'N/A' }}
                </td>
                <td>
                    {{-- Edit Button --}}
                    <a href="{{ route('roles.edit',$role->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>


                    {{-- Delete Button Only Active --}}
                   @if($role->status == 1)

                        <form action="{{ route('roles.destroy',$role->id) }}"
                            method="POST"
                            style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">
                    No roles found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-end">
    {{ $roles->appends(request()->query())->links() }}

</div>

@endsection
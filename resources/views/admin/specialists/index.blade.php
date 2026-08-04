@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                {{-- Header Section --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Specialist List</h4>
                        <p class="card-description">
                            Manage all specialists.
                        </p>
                    </div>

                    <a href="{{ route('specialists.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus mr-1"></i> Add Specialist
                    </a>
                </div>

                {{-- Success Message --}}
               

                {{-- Table Section with Theme's DataTables ID & Classes --}}
                <div class="table-responsive">

                    <table id="order-listing" class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="100">Status</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($specialists as $key => $specialist)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <strong>{{ $specialist->name }}</strong>
                                    </td>

                                    <td>
                                        {{ $specialist->description ?? '-' }}
                                    </td>

                                    <td>
                                        @if($specialist->status == '1' || $specialist->status == 1 || strtolower((string)$specialist->status) == 'active')
                                            <span class="status-pill status-active">
                                                <span class="dot"></span> Active
                                            </span>
                                        @else
                                            <span class="status-pill status-inactive">
                                                <span class="dot"></span> Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('specialists.edit', $specialist->id) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('specialists.destroy', $specialist->id) }}"
                                                  method="POST"
                                                  id="delete-form-{{ $specialist->id }}"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        title="Delete"
                                                        onclick="confirmDelete({{ $specialist->id }})">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>

                                            </form>
                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No Specialists Found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection

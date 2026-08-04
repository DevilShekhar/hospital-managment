@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Specialist List</h4>
                        <p class="card-description">
                            Manage all specialists.
                        </p>
                    </div>

                    <a href="{{ route('specialists.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Specialist
                    </a>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th width="80">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($specialists as $key => $specialist)

                                <tr>

                                    <td>
                                        {{ $specialists->firstItem() + $key }}
                                    </td>

                                    <td>
                                        {{ $specialist->name }}
                                    </td>

                                    <td>
                                        {{ $specialist->description ?? '-' }}
                                    </td>

                                    <td>
                                        @if($specialist->status == 'Active')
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

                                        <a href="{{ route('specialists.edit',$specialist->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('specialists.destroy',$specialist->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this specialist?')">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center">
                                        No Specialists Found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $specialists->links() }}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
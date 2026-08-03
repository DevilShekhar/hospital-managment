@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Queue Management</h4>
                        <p class="card-description">
                            Manage Patient Queue
                        </p>
                    </div>

                    <a href="{{ route('queues.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Queue
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Queue No.</th>
                                <th>Doctor</th>
                                <th>Department</th>
                                <th>Specialist</th>
                                <th>Visit Date</th>
                                <th>Priority</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($queues as $key => $queue)

                            <tr>

                                <td>{{ $queues->firstItem() + $key }}</td>

                                <td>{{ $queue->queue_number }}</td>

                                <td>
                                    {{ $queue->doctor->first_name ?? '' }}
                                    {{ $queue->doctor->last_name ?? '' }}
                                </td>

                                <td>
                                    {{ $queue->department->name ?? '-' }}
                                </td>

                                <td>{{ $queue->specialist }}</td>

                                <td>{{ $queue->visit_date }}</td>

                                <td>
                                    @if($queue->priority == 'Emergency')
                                        <span class="badge badge-danger">
                                            Emergency
                                        </span>

                                    @elseif($queue->priority == 'Urgent')
                                        <span class="badge badge-warning">
                                            Urgent
                                        </span>

                                    @else
                                        <span class="badge badge-success">
                                            Normal
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('queues.edit',$queue->id) }}"
                                        class="btn btn-sm btn-info">
                                        Edit
                                    </a>

                                    <form action="{{ route('queues.destroy',$queue->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this queue?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center">
                                    No Queue Found.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $queues->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
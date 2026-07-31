@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title mb-1">Role Management</h4>
                        <p class="card-description">
                            Manage all roles in the hospital management system.
                        </p>
                    </div>

                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        + Create Role
                    </a>
                </div>

                <!-- Search & Filter -->
                <div class="row mb-3">

                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Search Role">
                    </div>

                    <div class="col-md-3">
                        <select class="form-control">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Role Table -->
                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="thead-light">

                            <tr>
                                <th width="60">#</th>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th width="120">Status</th>
                                <th width="150">Created Date</th>
                                <th width="170">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>Full System Access</td>
                                <td>
                                    <span class="badge badge-success">
                                        Active
                                    </span>
                                </td>
                                <td>31-07-2026</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="#" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Doctor</td>
                                <td>Doctor Module Access</td>
                                <td>
                                    <span class="badge badge-success">
                                        Active
                                    </span>
                                </td>
                                <td>31-07-2026</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="#" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Receptionist</td>
                                <td>Appointment Management</td>
                                <td>
                                    <span class="badge badge-danger">
                                        Inactive
                                    </span>
                                </td>
                                <td>31-07-2026</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="#" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
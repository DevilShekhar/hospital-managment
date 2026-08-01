@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
<div class="page-header">
<h3 class="page-title">User Management</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">User Management</a></li>
<li class="breadcrumb-item active">User List</li>
</ol>
</nav>
</div>

<div class="card">
<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4 class="card-title">Hospital Users</h4>
<a href="{{ route('users.create') }}" class="btn btn-primary">+ Create User</a>
</div>

<div class="row mb-3">
<div class="col-md-4">
<input type="text" class="form-control" placeholder="Search User">
</div>
<div class="col-md-3">
<select class="form-control">
<option>All Status</option>
<option>Active</option>
<option>Inactive</option>
</select>
</div>
</div>

<div class="table-responsive">
<table id="order-listing" class="table table-bordered table-hover">
<thead>
<tr>
<th>ID</th><th>Employee ID</th><th>Name</th><th>Role</th><th>Department</th><th>Email</th><th>Mobile</th><th>Status</th><th>Action</th>
</tr>
</thead>
<tbody>
<tr><td>1</td><td>EMP001</td><td>Dr. Rajesh Sharma</td><td>Doctor</td><td>Cardiology</td><td>rajesh@hospital.com</td><td>9876543210</td><td><label class="badge badge-success">Active</label></td><td><a href="#" class="btn btn-sm btn-info">View</a> <a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Delete</a></td></tr>
<tr><td>2</td><td>EMP002</td><td>Priya Patel</td><td>Nurse</td><td>Emergency</td><td>priya@hospital.com</td><td>9876543211</td><td><label class="badge badge-success">Active</label></td><td><a href="#" class="btn btn-sm btn-info">View</a> <a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Delete</a></td></tr>
<tr><td>3</td><td>EMP003</td><td>Amit Verma</td><td>Receptionist</td><td>Reception</td><td>amit@hospital.com</td><td>9876543212</td><td><label class="badge badge-danger">Inactive</label></td><td><a href="#" class="btn btn-sm btn-info">View</a> <a href="#" class="btn btn-sm btn-warning">Edit</a> <a href="#" class="btn btn-sm btn-danger">Delete</a></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection
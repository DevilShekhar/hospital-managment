@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
@csrf

<div class="card mb-3">
<div class="card-header"><h4>Create User</h4></div>
<div class="card-body">
<div class="row">
<div class="col-md-4 mb-3">
<label>First Name *</label>
<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
</div>
<div class="col-md-4 mb-3">
<label>Last Name *</label>
<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
</div>
<div class="col-md-4 mb-3">
<label>Employee ID *</label>
<input type="text" name="employee_id" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Email *</label>
<input type="email" name="email" class="form-control">
</div>
<div class="col-md-4 mb-3">
<label>Mobile *</label>
<input type="text" name="mobile" class="form-control">
</div>
<div class="col-md-4 mb-3">
<label>Gender</label>
<select name="gender" class="form-control">
<option value="">Select</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Date of Birth</label>
<input type="date" name="dob" class="form-control">
</div>
<div class="col-md-4 mb-3">
<label>Department *</label>
<select class="form-control" name="department">
<option>Administration</option>
<option>Doctor</option>
<option>Nursing</option>
<option>Reception</option>
<option>Laboratory</option>
<option>Pharmacy</option>
<option>Accounts</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Role *</label>
<select class="form-control" name="role">
<option>Admin</option>
<option>Doctor</option>
<option>Nurse</option>
<option>Receptionist</option>
<option>Lab Technician</option>
<option>Pharmacist</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Password *</label>
<input type="password" name="password" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Confirm Password *</label>
<input type="password" name="password_confirmation" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Profile Photo</label>
<input type="file" name="photo" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Status</label>
<select class="form-control" name="status">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<div class="col-md-12 mb-3">
<label>Address</label>
<textarea class="form-control" name="address" rows="3"></textarea>
</div>

<div class="col-md-4 mb-3">
<label>City</label>
<input type="text" class="form-control" name="city">
</div>

<div class="col-md-4 mb-3">
<label>State</label>
<input type="text" class="form-control" name="state">
</div>

<div class="col-md-4 mb-3">
<label>Pincode</label>
<input type="text" class="form-control" name="pincode">
</div>



</div>
</div>

<div class="card-footer text-end">
<button class="btn btn-success">Save User</button>
<button type="reset" class="btn btn-warning">Reset</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</div>

</div>
</form>
</div>
@endsection
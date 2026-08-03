@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Doctor</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('doctors.index') }}">Doctors</a></li>
                    <li class="breadcrumb-item active">Edit Doctor</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Edit Doctor Details</h4>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $doctor->first_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $doctor->last_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $doctor->mobile) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Department <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ (old('department_id', $doctor->department_id) == $department->id) ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Profile Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            
                            @if(!empty($doctor->photo))
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Current Photo:</small>
                                    <img src="{{ asset('storage/' . $doctor->photo) }}" 
                                         alt="Doctor Photo" 
                                         class="img-thumbnail" 
                                         style="max-width: 100px; height: auto;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Doctor
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
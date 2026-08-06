@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('doctors.update', $doctor->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Doctor: {{ $doctor->first_name }} {{ $doctor->last_name }}</h4>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>

            <div class="card-body">
                <div class="row">

                    {{-- First Name --}}
                    <div class="col-md-4 mb-3">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="first_name"
                               name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name', $doctor->first_name) }}"
                               required>
                        @error('first_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-4 mb-3">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="last_name"
                               name="last_name"
                               class="form-control @error('last_name') is-invalid @enderror"
                               value="{{ old('last_name', $doctor->last_name) }}"
                               required>
                        @error('last_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Employee ID --}}
                    <div class="col-md-4 mb-3">
                        <label for="employee_id">Employee ID <span class="text-danger">*</span></label>
                        <input type="text"
                               id="employee_id"
                               name="employee_id"
                               class="form-control @error('employee_id') is-invalid @enderror"
                               value="{{ old('employee_id', $doctor->employee_id) }}"
                               required>
                        @error('employee_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4 mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $doctor->email) }}"
                               required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mobile --}}
                    <div class="col-md-4 mb-3">
                        <label for="mobile">Mobile <span class="text-danger">*</span></label>
                        <input type="tel"
                               id="mobile"
                               name="mobile"
                               inputmode="numeric"
                               pattern="[0-9]*"
                               class="form-control @error('mobile') is-invalid @enderror"
                               value="{{ old('mobile', $doctor->mobile) }}"
                               required>
                        @error('mobile')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="col-md-4 mb-3">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $doctor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $doctor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $doctor->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-4 mb-3">
                        <label for="dob">Date of Birth</label>
                        <input type="date"
                               id="dob"
                               name="dob"
                               class="form-control @error('dob') is-invalid @enderror"
                               value="{{ old('dob', $doctor->dob) }}">
                        @error('dob')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-4 mb-3">
                        <label for="department_id">Department <span class="text-danger">*</span></label>
                        <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $doctor->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Specialist / Specialization --}}
                    <div class="col-md-4 mb-3">
                        <label for="specialist_id">Specialist / Specialization</label>
                        <select class="form-control @error('specialist_id') is-invalid @enderror" name="specialist_id" id="specialist_id">
                            <option value="">Select Specialist</option>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}" {{ old('specialist_id', $doctor->specialist_id) == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specialist_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Profile Photo --}}
                    <div class="col-md-6 mb-3">
                        <label for="photo">Profile Photo</label>
                        <input type="file"
                               id="photo"
                               name="photo"
                               class="form-control @error('photo') is-invalid @enderror"
                               accept="image/*">
                        @if($doctor->photo)
                            <small class="text-success d-block mt-1">Current photo exists</small>
                        @endif
                        @error('photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                            <option value="1" {{ old('status', $doctor->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $doctor->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12 mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $doctor->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="col-md-4 mb-3">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $doctor->city) }}">
                        @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- State --}}
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" id="state" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state', $doctor->state) }}">
                        @error('state')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pincode --}}
                    <div class="col-md-4 mb-3">
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode', $doctor->pincode) }}">
                        @error('pincode')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Update Doctor</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

        </div>
    </form>
</div>
@endsection

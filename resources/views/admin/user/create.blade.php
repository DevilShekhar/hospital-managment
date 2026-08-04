@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Create User</h4>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
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
                               value="{{ old('first_name') }}" 
                               placeholder="Enter First Name"
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
                               value="{{ old('last_name') }}" 
                               placeholder="Enter Last Name"
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
                               value="{{ old('employee_id') }}" 
                               placeholder="e.g. EMP001"
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
                               value="{{ old('email') }}" 
                               placeholder="user@hospital.com"
                               required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mobile --}}
                    <div class="col-md-4 mb-3">
                        <label for="mobile">Mobile <span class="text-danger">*</span></label>
                        <input type="text" 
                               id="mobile" 
                               name="mobile" 
                               class="form-control @error('mobile') is-invalid @enderror" 
                               value="{{ old('mobile') }}" 
                               placeholder="Mobile Number"
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
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
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
                               value="{{ old('dob') }}">
                        @error('dob')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Dynamic Department --}}
                    <div class="col-md-4 mb-3">
                        <label for="department_id">Department <span class="text-danger">*</span></label>
                        <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Dynamic Role (Added Direct onchange) --}}
                    <div class="col-md-4 mb-3">
                        <label for="role_id">Role <span class="text-danger">*</span></label>
                        <select class="form-control @error('role_id') is-invalid @enderror" 
                                name="role_id" 
                                id="role_id" 
                                onchange="handleRoleChange(this)"
                                required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" 
                                        data-name="{{ strtolower($role->name) }}" 
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Specialist Wrapper (Hidden by default using style) --}}
                    <div class="col-md-4 mb-3" id="specialist_wrapper" style="display: none !important;">
                        <label for="specialist_id">Specialist / Specialization <span class="text-danger">*</span></label>
                        <select class="form-control @error('specialist_id') is-invalid @enderror" name="specialist_id" id="specialist_id">
                            <option value="">Select Specialist</option>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}" {{ old('specialist_id') == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specialist_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-md-6 mb-3">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-control" 
                               required>
                    </div>

                    {{-- Profile Photo --}}
                    <div class="col-md-6 mb-3">
                        <label for="photo">Profile Photo</label>
                        <input type="file" 
                               id="photo" 
                               name="photo" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               accept="image/*">
                        @error('photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12 mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="col-md-4 mb-3">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                        @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- State --}}
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" id="state" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}">
                        @error('state')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pincode --}}
                    <div class="col-md-4 mb-3">
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}">
                        @error('pincode')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Save User</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

        </div>
    </form>
</div>

{{-- Direct Script Tag to avoid @push dependency issues --}}
<script>
    function handleRoleChange(selectElement) {
        var wrapper = document.getElementById('specialist_wrapper');
        var specialistSelect = document.getElementById('specialist_id');

        if (!selectElement || selectElement.selectedIndex === -1) {
            wrapper.style.setProperty('display', 'none', 'important');
            return;
        }

        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var roleText = selectedOption.text.trim().toLowerCase();
        var dataName = selectedOption.getAttribute('data-name') ? selectedOption.getAttribute('data-name').toLowerCase() : '';

        if (roleText === 'doctor' || dataName === 'doctor') {
            wrapper.style.setProperty('display', 'block', 'important');
            specialistSelect.setAttribute('required', 'required');
        } else {
            wrapper.style.setProperty('display', 'none', 'important');
            specialistSelect.removeAttribute('required');
            specialistSelect.value = '';
        }
    }

    // Auto-check on page load
    window.addEventListener('load', function() {
        var roleSelect = document.getElementById('role_id');
        if (roleSelect) {
            handleRoleChange(roleSelect);
        }
    });
</script>
@endsection
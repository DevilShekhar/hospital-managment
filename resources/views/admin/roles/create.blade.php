@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h4 class="mb-0 fw-bold">Create Role</h4>
                            <small class="opacity-75">Hospital access and permission setup</small>
                        </div>
                        <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm px-3">
                            ← Back to Roles
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please fix these errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="doctor, nurse, receptionist"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="display_name" class="form-label fw-semibold">Display Name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="display_name"
                                    id="display_name"
                                    class="form-control form-control-lg @error('display_name') is-invalid @enderror"
                                    value="{{ old('display_name') }}"
                                    placeholder="Doctor, Nurse, Receptionist"
                                >
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Write a short description of this role"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select form-select-lg @error('status') is-invalid @enderror">
                                    <option value="">Select status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                                <input
                                    type="number"
                                    name="sort_order"
                                    id="sort_order"
                                    class="form-control form-control-lg @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', 1) }}"
                                    min="1"
                                >
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="guard_name" class="form-label fw-semibold">Guard Name</label>
                                <input
                                    type="text"
                                    name="guard_name"
                                    id="guard_name"
                                    class="form-control form-control-lg @error('guard_name') is-invalid @enderror"
                                    value="{{ old('guard_name', 'web') }}"
                                >
                                @error('guard_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="notes" class="form-label fw-semibold">Admin Notes</label>
                                <textarea
                                    name="notes"
                                    id="notes"
                                    rows="3"
                                    class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Optional internal notes"
                                >{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Save Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
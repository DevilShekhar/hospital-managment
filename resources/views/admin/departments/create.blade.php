@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Department Management</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Department Management</a></li>
                <li class="breadcrumb-item active">Add Department</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Department</h4>
            
            {{-- Updated Action Route: admin.departments.store --}}
            <form class="forms-sample" method="POST" action="{{ route('departments.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Department Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="e.g. Cardiology, Pediatrics" value="{{ old('name') }}" required>
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Brief description of the department">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control" id="status" required>
        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
</div>

                <button type="submit" class="btn btn-primary mr-2">Save Department</button>
                
                <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
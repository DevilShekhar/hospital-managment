@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Add New Department</h4>
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
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary mr-2">Save Department</button>
            <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('content')


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Department</h4>
        <form class="forms-sample" method="POST" action="{{ route('departments.update', $department->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $department->name) }}" required>
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4">{{ old('description', $department->description) }}</textarea>
                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active" {{ old('status', $department->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $department->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary mr-2">Update Department</button>
            <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
</div>
@endsection
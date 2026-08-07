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
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ old('name', $department->name) }}" required>
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"
                        rows="4">{{ old('description', $department->description) }}</textarea>
                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <select name="status" class="form-control">
                    <option value="1"
                        @if($department->status == 1) selected @endif>
                        Active
                    </option>
                    <option value="0"
                        @if($department->status == 0) selected @endif>
                        Inactive
                    </option>
                </select>

                <button type="submit" class="btn btn-primary mr-2">Update Department</button>
                <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
@endsection
@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Department Management</h3>
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

        

                <button type="submit" class="btn btn-primary mr-2">Save Department</button>
                
                <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
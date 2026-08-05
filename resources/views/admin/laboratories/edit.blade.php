@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="card-title">Edit Laboratory Test</h4>
                        <p class="card-description">
                            Update Laboratory Test Details
                        </p>
                    </div>

                    <a href="{{ route('laboratories.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('laboratories.update', $laboratory->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Lab Code <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="lab_code"
                                   class="form-control"
                                   value="{{ old('lab_code', $laboratory->lab_code) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Test Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="test_name"
                                   class="form-control"
                                   value="{{ old('test_name', $laboratory->test_name) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Department <span class="text-danger">*</span></label>

                            <select name="department_id" class="form-control">

                                <option value="">Select Department</option>

                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $laboratory->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Category</label>

                            <select name="category" class="form-control">

                                @foreach($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ old('category', $laboratory->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Sample Type</label>

                            <select name="sample_type" class="form-control">

                                @foreach($sampleTypes as $sample)
                                    <option value="{{ $sample }}"
                                        {{ old('sample_type', $laboratory->sample_type) == $sample ? 'selected' : '' }}>
                                        {{ $sample }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Container Type</label>

                            <select name="container_type" class="form-control">

                                @foreach($containerTypes as $container)
                                    <option value="{{ $container }}"
                                        {{ old('container_type', $laboratory->container_type) == $container ? 'selected' : '' }}>
                                        {{ $container }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Price (₹)</label>

                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price', $laboratory->price) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Turnaround Time (Hours)</label>

                            <input type="number"
                                   name="turnaround_time"
                                   class="form-control"
                                   value="{{ old('turnaround_time', $laboratory->turnaround_time) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Fasting Required</label>

                            <select name="fasting_required" class="form-control">
                                <option value="1" {{ old('fasting_required', $laboratory->fasting_required) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('fasting_required', $laboratory->fasting_required) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Home Collection</label>

                            <select name="home_collection" class="form-control">
                                <option value="1" {{ old('home_collection', $laboratory->home_collection) == 1 ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('home_collection', $laboratory->home_collection) == 0 ? 'selected' : '' }}>Not Available</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>

                            <select name="status" class="form-control">
                                <option value="1"
                                    {{ old('status', $laboratory->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status', $laboratory->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                                                <div class="col-md-12 mb-3">
                            <label>Description</label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control">{{ old('description', $laboratory->description) }}</textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        Update Laboratory Test
                    </button>

                    <a href="{{ route('laboratories.index') }}" class="btn btn-light">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
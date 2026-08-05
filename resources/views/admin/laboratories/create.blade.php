@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Add Laboratory Test</h4>
                        <p class="card-description">
                            Create a New Laboratory Test
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

                <form action="{{ route('laboratories.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Lab Code -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Lab Test Code <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="lab_code"
                                   class="form-control"
                                   value="{{ old('lab_code') }}"
                                   placeholder="LAB001"
                                   required>
                        </div>

                        <!-- Test Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Test Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="test_name"
                                   class="form-control"
                                   value="{{ old('test_name') }}"
                                   placeholder="Complete Blood Count"
                                   required>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Department <span class="text-danger">*</span>
                            </label>

                            <select name="department_id" class="form-control" required>

                                <option value="">Select Department</option>

                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Category <span class="text-danger">*</span>
                            </label>

                            <select name="category" class="form-control" required>

                                <option value="">Select Category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Sample Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Sample Type <span class="text-danger">*</span>
                            </label>

                            <select name="sample_type" class="form-control" required>

                                <option value="">Select Sample</option>

                                @foreach($sampleTypes as $sampleType)
                                    <option value="{{ $sampleType }}"
                                        {{ old('sample_type') == $sampleType ? 'selected' : '' }}>
                                        {{ $sampleType }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Container Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Container Type <span class="text-danger">*</span>
                            </label>

                            <select name="container_type" class="form-control" required>

                                <option value="">Select Container</option>

                                @foreach($containerTypes as $containerType)
                                    <option value="{{ $containerType }}"
                                        {{ old('container_type') == $containerType ? 'selected' : '' }}>
                                        {{ $containerType }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Price -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Price (₹) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price') }}"
                                   required>
                        </div>

                        <!-- Turnaround Time -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Turnaround Time (Hours) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="turnaround_time"
                                   class="form-control"
                                   value="{{ old('turnaround_time') }}"
                                   required>
                        </div>

                        <!-- Fasting -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Fasting Required
                            </label>

                            <select name="fasting_required" class="form-control">

                                <option value="1"
                                    {{ old('fasting_required') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="0"
                                    {{ old('fasting_required') == '0' ? 'selected' : '' }}>
                                    No
                                </option>

                            </select>
                        </div>

                        <!-- Home Collection -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Home Collection
                            </label>

                            <select name="home_collection" class="form-control">

                                <option value="1"
                                    {{ old('home_collection') == '1' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="0"
                                    {{ old('home_collection') == '0' ? 'selected' : '' }}>
                                    Not Available
                                </option>

                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control">{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary">
                            Save Laboratory Test
                        </button>

                        <a href="{{ route('laboratories.index') }}"
                           class="btn btn-light">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
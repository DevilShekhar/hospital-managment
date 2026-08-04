@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                {{-- Card Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Edit Specialist</h4>
                        <p class="card-description">
                            Update details for: <strong>{{ $specialist->name }}</strong>
                        </p>
                    </div>

                    <a href="{{ route('specialists.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                {{-- Global Errors Alert --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Start --}}
                <form action="{{ route('specialists.update', $specialist->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Specialist Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Specialist Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $specialist->name) }}"
                                placeholder="Enter Specialist Name"
                                required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Status (Dynamic Checking for 1, '1', 'Active') -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>

                            @php
                                $currentStatus = old('status', $specialist->status);
                                $isActive = in_array(strtolower((string)$currentStatus), ['1', 'active', 'true'], true);
                            @endphp

                           <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="1" {{ old('status', $specialist->status) == 1 || old('status', $specialist->status) == '1' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status', $specialist->status) == 0 || old('status', $specialist->status) == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description">{{ old('description', $specialist->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    {{-- Form Actions --}}
                    <div class="text-end">

                        <button type="reset" class="btn btn-light">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Specialist
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
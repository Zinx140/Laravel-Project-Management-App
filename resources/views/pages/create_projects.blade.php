@extends('layouts.main')

@section('content')
    <div class="container my-5 d-flex">
        <a href="{{ route('manager-projects') }}">
            <div class="btn btn-light">
                Back to Projects
            </div>
        </a>
        <div class="ms-3">
            <h3 class="text-white">Create New Project</h3>
        </div>
    </div>

    {{-- form --}}
    <div class="container p-5 rounded bg-white">
        <form action="{{ route('doCreate') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Project Title</label>
                <input type="text" class="form-control" name="project_title" value="{{ old('project_title') }}">
                @error('project_title')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Project Description</label>
                <textarea class="form-control" name="project_description" rows="3">{{ old('project_description') }}</textarea>
                @error('project_description')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control" placeholder="dd/mm/yyyy"
                        value="{{ old('start_date') }}">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                </div>
                @error('start_date')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">End Date</label>
                <div class="input-group">
                    <input type="date" name="end_date" class="form-control" placeholder="dd/mm/yyyy"
                        value="{{ old('end_date') }}">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                </div>
                @error('end_date')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Add Members</label>
                <div class="form-control">

                    @foreach ($employees as $employee)
                        <div class="form-control my-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $employee['email'] }}"
                                    name="members[]">
                                <label class="form-check-label">
                                    {{ $employee['name'] }} <span class="text-secondary">({{ $employee['email'] }})</span>
                                </label> <br>
                            </div>
                        </div>
                    @endforeach

                    @error('members')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
            </div>
            <div class="mb-4">

            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button class="btn btn-primary">Create Project</button>
            </div>
        </form>
    </div>
@endsection

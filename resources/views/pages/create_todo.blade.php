@extends('layouts.main')

@section('content')
    <div class="container my-5 d-flex">
        <a href="{{ route('manager-project-detail', ['id' => $project['id']]) }}">
            <div class="btn btn-light">
                Back
            </div>
        </a>
        <div class="ms-3">
            <h3 class="text-white">Create Todolist Item</h3>
        </div>
    </div>

    <div class="container p-5 rounded bg-white">
        <form action="{{ route('do-create-todo', ['id' => $project['id']]) }}" method="post">
            @csrf
            <input type="hidden" name="end_date" value="{{ $project['end_date'] }}">
            <div class="mb-3">
                <label class="form-label">Todolist Name</label>
                <input type="text" class="form-control" name="todolist_name">
                @error('todolist_name')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Assigned To</label>
                <select name="assigned_to" class="form-select">
                    <option value="" disabled selected hidden>-- Select Employee --</option>

                    @foreach ($employees as $employee)
                        <option value="{{ $employee['email'] }}">{{ $employee['name'] }}</option>
                    @endforeach

                </select>
                @error('assigned_to')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4 row">
                <div class="col">
                    <label class="form-label">Start Date</label>
                    <div class="input-group">
                        <input type="date" name="start_date" class="form-control" placeholder="dd/mm/yyyy">
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
                <div class="col">
                    <label class="form-label">Deadline</label>
                    <div class="input-group">
                        <input type="date" name="deadline" class="form-control" placeholder="dd/mm/yyyy">
                        <span class="input-group-text">
                            <i class="bi bi-calendar"></i>
                        </span>
                    </div>
                    @error('deadline')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                    @error('end_date')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="action d-flex justify-content-end gap-2">
                <button class="btn btn-primary" type="submit">
                    Create
                </button>
                <a href="{{ route('manager-project-detail', ['id' => $project['id']]) }}">
                    <div class="btn btn-secondary">Cancel</div>
                </a>
            </div>
        </form>
    </div>
@endsection

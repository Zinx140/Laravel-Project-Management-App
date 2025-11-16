@extends('layouts.main')

@section('content')
    <div class="container my-5 d-flex">
        <a href="{{ route('manager-projects') }}">
            <div class="btn btn-light">
                Back to Projects
            </div>
        </a>
        <div class="ms-3">
            <h3 class="text-white">Project Detail</h3>
        </div>
    </div>

    <div class="container p-2 bg-white rounded">
        <div class="heaader d-flex justify-content-between align-items-baseline px-2 pt-4">
            <h4>
                {{ $project['name'] }}
            </h4>
            <p class="">
                Status
            </p>
        </div>
        <div class="header-info d-flex justify-content-between px-2 mb-3">
            <div class="project-info">
                <p>Managed by: {{ $project['manager'] }}</p>
                <p>{{ $project['description'] }}</p>
                <p>
                    Start: <span>{{ $project['start_date'] }}</span>
                    <i class="bi bi-dot"></i>
                    End:
                    <span>{{ $project['end_date'] }}</span>
                </p>
            </div>
            <div class="project-status">
                <form action="{{ route('update-project-status', ['id' => $project['id']]) }}" method="post">
                    @csrf
                    <select class="form-select" name="status">

                        @if ($project['status'] == 'In Progress')
                            <option value="In Progress" selected>In Progress</option>
                        @else
                            <option value="In Progress">In Progress</option>
                        @endif

                        @if ($project['status'] == 'Todo')
                            <option value="Todo" selected>Todo</option>
                        @else
                            <option value="Todo">Todo</option>
                        @endif

                        @if ($project['status'] == 'Completed')
                            <option value="Completed" selected>Completed</option>
                        @else
                            <option value="Completed">Completed</option>
                        @endif

                    </select> <br>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>

        <hr>
        <div class="container d-flex justify-content-between align-items-center mb-2">
            <h5>Todolist</h5>
            <a href="{{ route('manager-create-todo', ['id' => $project['id']]) }}">
                <button class="btn btn-success">+ Create Todo</button>
            </a>
        </div>
        <div class="container mb-3">

            @foreach ($project['todolists'] as $todolist)
                <div class="w-100 p-3 my-2 bg-dark rounded text-white">
                    <div class="todolist-header d-flex justify-content-between">
                        <p class="fw-bold">{{ $todolist['todolist_name'] }}</p>

                        <div class="todolist-info">
                            @if ($todolist['status'] == 'Todo')
                                <span class="badge text-bg-danger">Todo</span>
                            @elseif ($todolist['status'] == 'In Progress')
                                <span class="badge text-bg-warning">In Progress</span>
                            @else
                                <span class="badge text-bg-success">Done</span>
                            @endif
                        </div>
                    </div>
                    <p class="lh-1">Assigned to: {{ $todolist['assigned_to'] }}</p>
                    <p class="lh-1">Start: {{ $todolist['start_date'] }}</p>
                    <p class="lh-1">Deadline: {{ $todolist['deadline'] }}</p>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="container my-5 d-flex">
        <a href="{{ route('employee-projects') }}">
            <div class="btn btn-light">
                Back to Projects
            </div>
        </a>
        <div class="ms-3">
            <h3 class="text-white">Project Detail</h3>
        </div>
    </div>

    <div class="container p-2 bg-white rounded">
        <div class="heaader px-2 pt-4">
            <h4>
                {{ $project['name'] }}
            </h4>
        </div>
        <div class="px-2 mb-3">
            <div class="project-info lh-1">
                <p>{{ $project['description'] }}</p>
                <p>
                    Start: <span>{{ $project['start_date'] }}</span>
                    <i class="bi bi-dot"></i>
                    End:
                    <span>{{ $project['end_date'] }}</span>
                </p>
            </div>
        </div>
        <hr>
        <div class="container mb-2">
            <h5 class="mb-2">Your Todolist</h5>

            <div class="row w-100">
                @foreach ($project['todolists'] as $i => $todolist)
                    @if ($todolist['assigned_to_email'] == session('user_login')['email'])
                        <div class="col-14 col-md-6 col-xl-4 p-2">
                            <div class="bg-dark p-2 text-white rounded">
                                <div class="todolist-info lh-1">
                                    <p style="fw-bold">
                                        {{ $todolist['todolist_name'] }}
                                    </p>
                                    <p class="fw-light">Start: {{ $todolist['start_date'] }}</p>
                                    <p class="fw-light">Deadline: {{ $todolist['deadline'] }}</p>
                                </div>
                                <div class="todolist-status d-flex justify-content-between">
                                    <form
                                        action="{{ route('employee-update-todo', ['todo_id' => $i, 'id' => $project['id']]) }}"
                                        method="post" class="d-flex gap-2">
                                        @csrf
                                        <select name="status" class="form-select">
                                            @if ($todolist['status'] == 'In Progress')
                                                <option value="In Progress" selected>In Progress</option>
                                            @else
                                                <option value="In Progress">In Progress</option>
                                            @endif

                                            @if ($todolist['status'] == 'Todo')
                                                <option value="Todo" selected>Todo</option>
                                            @else
                                                <option value="Todo">Todo</option>
                                            @endif

                                            @if ($todolist['status'] == 'Done')
                                                <option value="Completed" selected>Done</option>
                                            @else
                                                <option value="Completed">Done</option>
                                            @endif
                                        </select>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                    <div class="curr-status">
                                        @if ($todolist['status'] == 'Todo')
                                            <span class="badge text-bg-danger">Todo</span>
                                        @elseif ($todolist['status'] == 'In Progress')
                                            <span class="badge text-bg-warning">In Progress</span>
                                        @else
                                            <span class="badge text-bg-success">Done</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

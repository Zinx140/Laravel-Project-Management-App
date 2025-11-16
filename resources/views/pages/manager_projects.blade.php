@extends('layouts.main')

@section('content')
    <div class="container my-5  d-flex justify-content-between">
        <h3 class="text-white">Welcome, Manager {{ session('user_login')['name'] }}</h3>
        <a href="{{ route('create-manager-projects') }}">
            <button class="btn btn-primary">
                + Create New Project
            </button>
        </a>
    </div>

    <div class="container d-flex justify-content-center">

        <div class="row w-100">
            @foreach ($projects as $project)
                <div class="col-12 col-lg-6 col-xl-4 my-2">
                    <div class="bg-dark p-2 h-100">
                        <div class="d-flex justify-content-center w-100">
                            <div class="row w-100">
                                <div class="col-8">
                                    <div class="d-flex justify-content-start">
                                        <h5 class="text-white">
                                            {{ $project['name'] }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-end align-items-center">

                                    @if ($project['status'] == 'Todo')
                                        <span class="badge text-bg-danger">Todo</span>
                                    @elseif ($project['status'] == 'In Progress')
                                        <span class="badge text-bg-warning">In Progress</span>
                                    @else
                                        <span class="badge text-bg-success">Completed</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="project-detail px-2 pt-2">
                            <p class="text-white text-wrap lh-1 fw-light">Start: {{ $project['start_date'] }}</p>
                            <p class="text-white text-wrap lh-1 fw-light">End: {{ $project['end_date'] }}</p>
                            <p class="text-white text-wrap lh-1 fw-light">
                                @if (strlen($project['description']) > 50)
                                    {{ substr($project['description'], 0, 47) }}...
                                @else
                                    {{ $project['description'] }}
                                @endif
                            </p>
                        </div>
                        <div class="project-action d-flex gap-2 pb-2 px-2">
                            <a href="{{ route('manager-project-detail', ['id' => $project['id']]) }}">
                                <button class="btn btn-outline-light" type="submit">View</button>
                            </a>
                            <form action="{{ route('delete-project', ['id' => $project['id']]) }}" method="post">
                                @csrf
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

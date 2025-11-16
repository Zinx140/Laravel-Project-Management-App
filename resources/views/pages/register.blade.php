@extends('layouts.auth')

@section('content')
    <div class="bg-white rounded p-5" style="min-width: 300px; width: 60%; margin-top: 20px">
        <h1 class="text-center">ClickDown</h1>
        <h6 class="text-center">Register</h6>
        <form action="{{ route('doRegister') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
                @error('confirm_password')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Role</label>
                <select class="form-select" id="form-role" aria-label="Default select example" name="role">
                    <option value="Employee">Employee</option>
                    <option value="Manager">Manager</option>
                </select>
                @error('role')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary w-100">Register</button>
            </div>
        </form>
        <p class="text-center mb-3">Already have an account? <a href="{{ route('login') }}">Login</a></p>

        @if (session('err'))
            <p class="text-danger text-center">
                {{ session('err') }}
            </p>
        @endif

        @if (session('success'))
            <p class="text-success text-center">
                {{ session('success') }}
            </p>
        @endif

    </div>
@endsection

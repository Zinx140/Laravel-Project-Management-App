@extends('layouts.auth')

@section('content')
    <div class="bg-white rounded p-5" style="min-width: 300px; width: 60%; margin-top: 100px">
        <h1 class="text-center">ClickDown</h1>
        <h6 class="text-center">Login</h6>
        <form action="{{ route('doLogin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
        <p class="text-center mb-3">Dont't have an account? <a href="{{ route('register') }}">Register</a></p>

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

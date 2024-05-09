@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
    <form method="POST" action="{{ route('register.store') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="mb-2 text-muted" for="name">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @endError" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="username">Username</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @endError" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @endError" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @endError" name="password" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="password-confirmation">Confirm Password</label>
            <input id="password-confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @endError" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @endError
        </div>

        <div class="align-items-center d-flex">
            <button type="submit" class="btn btn-primary ms-auto">
                Register	
            </button>
        </div>
    </form>
@endsection

@section('footer')
    <div class="card-footer py-3 border-0">
        <div class="text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-dark">Login</a>
        </div>
    </div>
@endSection
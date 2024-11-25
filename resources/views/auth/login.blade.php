@extends('auth.layouts.main')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
    <form method="POST" class="needs-validation" action="{{ route('authenticate') }}" novalidate="" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @endError" name="email" value="" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @endError
        </div>

        <div class="mb-3">
            <div class="mb-2 w-100">
                <label class="text-muted" for="password">Password</label>

            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @endError" name="password" required>
            @error('password')
                <div class="invalid-feedback">
                    Password is required
                </div>
            @endError
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary ms-auto">
                Login
            </button>
        </div>
    </form>
@endsection

@section('footer')
    <div class="card-footer py-3 border-0">
        <div class="text-center">
            Don't have an account? <a href="{{ route('register.index') }}" class="text-dark">Create One</a>
        </div>
    </div>
@endSection
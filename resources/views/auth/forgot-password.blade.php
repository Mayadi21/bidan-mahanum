@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">Forgot Password</h1>

    @error('email')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
            <div class="invalid-feedback">
                Email is invalid
            </div>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary ms-auto">
                Send Link	
            </button>
        </div>
    </form>
@endsection

@section('footer')
    <div class="card-footer py-3 border-0">
        <div class="text-center">
            Remember your password? <a href="{{ route('login') }}" class="text-dark">Login</a>
        </div>
    </div>
@endSection
@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">Reset Password</h1>
    
    @error('email')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    @error('password')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request()->email }}">
        <div class="mb-3">
            <label class="mb-2 text-muted" for="password">New Password</label>
            <input id="password" type="password" class="form-control" name="password" value="" required autofocus>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary ms-auto">
                Reset Password	
            </button>
        </div>
    </form>
@endsection

@section('footer')
    
@endSection
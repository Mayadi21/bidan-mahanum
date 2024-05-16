@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">Change Password</h1>
    
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @error('password')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('password.modify') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <input type="hidden" name="email" value="{{ request()->email }}">
        <div class="mb-3">
            <label class="mb-2 text-muted" for="current-password">Current Password</label>
            <input id="current-password" type="password" class="form-control" name="current_password" value="" required autofocus>
            @error('current_password')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @enderror
        </div>
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
                Change Password	
            </button>
        </div>
    </form>
@endsection

@section('footer')
    
@endSection
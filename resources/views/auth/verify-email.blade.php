@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold my-4">Verify Email</h1>

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h5 class="mt-4">Email verification has been sent to your email. Please check your email for a verification link.</h5>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mt-3">Resend Verification Link</button>
    </form>
    <a href="{{ route('logout') }}" class="mt-3 d-block">Logout</a></a>
@endsection

@section('footer')
    
@endSection
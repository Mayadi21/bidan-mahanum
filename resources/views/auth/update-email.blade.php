@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">New Email</h1>

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

    <form method="POST" action="{{ route('email.update') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="mb-2 text-muted" for="email">New E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary ms-auto">
                Send Link	
            </button>
        </div>
    </form>
@endsection

@section('footer')

@endSection
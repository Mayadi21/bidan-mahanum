@extends('auth.layouts.main')

@section('content')
    <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
    <div class="container">
        <!-- Pesan Notifikasi -->
        @if(session('success'))
        <div class="alert alert-success col-lg-8">
            {{ session('success') }}
        </div>
        @endif
    
        @if(session('error'))
        <div class="alert alert-danger col-lg-8">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <form method="POST" action="{{ route('register.store') }}" class="needs-validation" novalidate="" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="mb-2 text-muted" for="nama">Nama</label>
            <input id="nama" type="text" class="form-control @error('nama') is-invalid @endError" name="nama" value="{{ old('nama') }}" required autofocus>
            @error('nama')
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
            <label class="mb-2 text-muted" for="alamat">Alamat</label>
            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @endError" name="alamat" value="{{ old('alamat') }}" >
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @endError
        </div>
        
        <div class="mb-3">
            <label class="mb-2 text-muted" for="tanggal_lahir">Tanggal Lahir</label>
            <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @endError" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
            @error('tanggal_lahir')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="pekerjaan">Pekerjaan</label>
            <input id="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @endError" name="pekerjaan" value="{{ old('pekerjaan') }}" >
            @error('pekerjaan')
                <div class="invalid-feedback">
                    {{ $message }}	
                </div>
            @endError
        </div>

        <div class="mb-3">
            <label class="mb-2 text-muted" for="no_hp">Nomor Telepon</label>
            <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @endError" name="no_hp" value="{{ old('no_hp') }}" required>
            @error('no_hp')
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
@extends('blog.layouts.main')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Profil Saya</h2>
    <div class="container">
            <!-- Pesan Notifikasi -->
        @if(session('success'))
        <div class="alert alert-success col-lg-12">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger col-lg-12">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Nama</div>
                <div class="col-md-8">{{ $user->nama }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Email</div>
                <div class="col-md-8">{{ $user->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Tanggal Lahir</div>
                <div class="col-md-8">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Alamat</div>
                <div class="col-md-8">{{ $user->alamat ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Pekerjaan</div>
                <div class="col-md-8">{{ $user->pekerjaan ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Nomor HP</div>
                <div class="col-md-8">{{ $user->no_hp }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Status</div>
                <div class="col-md-8">{{ ucfirst($user->status) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Role</div>
                <div class="col-md-8">{{ ucfirst($user->role) }}</div>
            </div>

            <!-- Tombol Edit -->
            <div class="text-center mt-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profil</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $user->tanggal_lahir }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ $user->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ $user->pekerjaan }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $user->no_hp }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
